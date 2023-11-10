<?php

namespace App\Http\Controllers;

use App\Model\Travailleur;
use App\Model\Categorie;
use App\Model\Prod;
use App\Model\Operation;
use App\Model\DetailOperation;
use App\Model\Eleve;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AdminTravController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:travailleurs,admins');
    }


    public function index()
    {

        $cats=Categorie::all();
        $articles=Prod::all();
       

        return view('Trav.index')->with('cats',$cats)->with('articles',$articles);
    }


    public function store(Request $request)
    {


        // $this->validate($request, [
        // 'nom' => 'required|string|between:1,30',
        // 'username' => 'required|string|between:1,30',
        // 'password' => 'required|string|between:1,20',
        // ]);

        // $travailleur = new Travailleur;

        // $travailleur = 

        Travailleur::create([
            'canprint'=>$request->canprint,
            'id_user'=>Auth::user()->id,
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'modeCaisse'=>$request->modeCaisse,
            'type'=>$request->type,
            'nom'=>$request->nom,

        ]); 

        \Session::flash('message', 'travailleur avec succès !!'); 

        return redirect()->route('admin.index_travailleur');
    }


    public function edit($id)
    {
        $travailleur = Travailleur::find($id);
        return view('Admin.Trav.edit')->with('travailleur',$travailleur);
    }


    public function update(Request $request)
    {
        $travailleur = Travailleur::find($request->id);
        $travailleur->nom = $request->nom;
        $travailleur->username = $request->username;
        $travailleur->modeCaisse = $request->modeCaisse;
        $travailleur->type = $request->type;
        $travailleur->canprint = $request->canprint;
        
        $travailleur->save();

        \Session::flash('message', 'informations ont été bien modifiées !!'); 

        return redirect()->back();
    }

    public function updatepassword(Request $request)
    {

        if(is_null($request->password) || strlen($request->password)<6)
        {
            \Session::flash('message_update_password_error', 'Mot de passe doît contenir au moins 6 caractères'); 
            return redirect()->back()->withInput(Input::all());

        }
        $travailleur = Travailleur::find($request->id);
        
       
        $travailleur->password = Hash::make($request->password);
        $travailleur->save();

        \Session::flash('message_update_password_message', 'informations ont été bien modifiées !!'); 
     

        return redirect()->back();
    }
    

    public function destroy($id)
    {
        $travailleur = Travailleur::find($id);
        $travailleur->delete();

        \Session::flash('message', 'travailleur a ete supprimer !!'); 

        return redirect()->back();
    }


    
    public function getprodbycode_bar(Request $data)
    { 
        $qte=0; 

        if ($data->code_bar =="") {
          
            $jsonmsg = array("msg" => "error" , "text" => "code bar est vide");
            return   response()->json($jsonmsg);
        }

        if(substr($data->code_bar, 0, 4)=="2100")
        {

            $code_bar = substr($data->code_bar, 0, 7);
            $prod_qte =  substr( substr($data->code_bar, -6),0,5);
            $prod =  Prod::where( DB::raw('LOWER(code_bar)'),strtolower($code_bar))->first();
        }
        else{
        $prod =  Prod::where( DB::raw('LOWER(code_bar)'),strtolower($data->code_bar))->first();
        }
        if(!$prod)
        {
            $jsonmsg = array("msg" => "error" , "text" => "Code Bar Produit invalid");
            return   response()->json($jsonmsg);
        }

        if($code_bar)
        {
        $ticket = array(
        "id" => $prod->id, 
        "prix" => $prod->prix_vente,
        "qteact" => $prod->qte,
        "qte" => 1,
        "name" => $prod->lebelle,
        "uniteog" =>$prod->unite,
        "unite" =>$prod->unite,
        "prodqte" => $prod_qte
         );
        }
        else{
            $ticket = array(
                "id" => $prod->id, 
                "prix" => $prod->prix_vente,
                "qteact" => $prod->qte,
                "qte" => 1,
                "name" => $prod->lebelle,
                "uniteog" =>$prod->unite,
                "unite" =>$prod->unite
                 );
        }

        $jsonmsg = array("msg" => "success" , 
        "text" => "Code Bar Produit invalid",
        "data" =>$ticket
    );
        return   response()->json($jsonmsg);
       

    }
    public function ticket(Request $data)
    { 
        $qte=0; 


     

        if ($data->ticket =="") {
          
            $jsonmsg = array("msg" => "error" , "text" => "Ticket est vide");
            return   response()->json($jsonmsg);
        }
        if ($data->idPrnsl =="") {
          
            $jsonmsg = array("msg" => "error" , "text" => "Code Bar est vide");
            return   response()->json($jsonmsg);
        }

        $Eleve =  Eleve::where(DB::raw('SUBSTR(MD5(id),1,10)'),strtolower($data->idPrnsl))->first();
    
        if(!$Eleve)
        {
            $jsonmsg = array("msg" => "error" , "text" => "Code Bar invalid");
            return   response()->json($jsonmsg);
        }

        if($data->type == "R")
        {
            if( $Eleve->sold_r < floatval($data->prixPayer)){
                $jsonmsg = array("msg" => "error" , "text" => "Solde Eleve insuffisant");
            return   response()->json($jsonmsg);
            }
            else{
                $Eleve->sold_r -= floatval($data->prixPayer);
                $Eleve->update();
            }
        }
        else{
            if( $Eleve->sold_b <floatval($data->prixPayer)){
                $jsonmsg = array("msg" => "error" , "text" => "Solde Eleve insuffisant");
            return   response()->json($jsonmsg);
            }
            else{
                $Eleve->sold_b -=floatval($data->prixPayer);
                $Eleve->update();
            }
        }

        $operation = new Operation;
        $operation->id_trav = Auth::user()->id;
        $operation->date_operation = date('Y-m-d H:i:s');
        $operation->numtick =Str::random(6);
        $operation->prixPayer =floatval($data->prixPayer);
        $operation->id_eleve = $Eleve->id;
        
        $operation->save();


        foreach ($data->ticket as $key => $value) {

            $detailOperation = new DetailOperation;
            $detailOperation->id_trav = Auth::user()->id;
            $detailOperation->id_operation = $operation->id;
            $detailOperation->id_prod = $value['idProd'];          

            $detailOperation->prix = $value['prix'];
            $detailOperation->qte_prod = $value['qte'];
            $qte=$value['qte'];
            $detailOperation->save();

            $prod = Prod::where('id',$value['idProd'])->first();
            $prod->qte=($prod->qte-$qte);
            $prod->save();
        }
      
        $jsonmsg = array("msg" => "success" , 
        "text" => "Operation termine avec succès",
           "data"=> array( "eleve" =>$Eleve,"tickt" => $operation ));
        return   response()->json($jsonmsg);
    }


    public function  get_ticket($id){


        $operation = Operation::find($id);
        $Eleve =  Eleve::find($operation->id_eleve);

        $DetailOperation =  DetailOperation::where("id_operation",$id)->get();


        $tickets=[];
        foreach ($DetailOperation as $key ) {
            # code...
        
            $prod =  Prod::find($key->id_prod);

            $tickets[] = array(
                "id" => $prod->id, 
                "prix" => $prod->prix_vente,
                "qteact" => 0,
                "qte" => $key->qte_prod,
                "name" => $prod->lebelle,
                "uniteog" =>$prod->unite,
                "unite" =>$prod->unite
                );
        }

        $jsonmsg = array("msg" => "success" , 
           "text" => "Operation termine avec succès",
           "data"=> array( "eleve" =>$Eleve,
                            "tickt" => $operation ,
                            "detail" => $tickets));

        return   response()->json($jsonmsg);
    }

    public function modeCaisse(Request $data){
        $trav = Travailleur::where('id',Auth::user()->id)->first();
        $trav->modeCaisse = $data->id;
        $trav->save();
        return 'done';
    }

    public function menuPrsnl(Request $data){

        $prnsl = Eleve::where('idBadge',$data->idPrnsl)->first();
        if (empty($prnsl)) {
            return false;
        }
         $trav = MenuPersnl::where('id_type',$prnsl->id_type)
                            ->where('id_menu',Auth::user()->modeCaisse)
                            ->first();


        $count=1;
        $prixPrnsl=0;
        foreach ($data->ticket as $key => $value) {
            $prodPrix = Prod::where('id',$value['idProd'])->first();
            for ($i=1; $i <= $value['qte']; $i++) { 
                if ($count <= $trav->numArticles) {
                    $prixPrnsl = $prixPrnsl+$prodPrix->prix-(($prodPrix->prix*$trav->pourcentage)/100);
                }else{
                    $prixPrnsl = $prixPrnsl+$prodPrix->prix;
                }
                $count=$count+1;
            }
        }

        return response()->json(['prixPrnsl' => $prixPrnsl]);
    }

    public function badge(){
        return view('Trav.badge');
    }
}
