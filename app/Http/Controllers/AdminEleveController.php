<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Eleve;
use App\Model\Classe;
use App\Model\DetailSold;
use App\Model\Niveau;
use App\Model\Operation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Redirect;

use PDF;
use DB;

class AdminEleveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
    }


    
    public function index()
    {
      
        $niveaux =Auth::user()->niveaux;

           return view('Admin.Etudiant.index')->with('niveaux',$niveaux);

    }

    public function summaryPerClient($id){
        $client = Eleve::find($id);
        return view('Admin.Etudiant.summary_select',['client'=>$client]);
    }
    public function summaryPerClientData(Request $request){
        
        $op = Operation::query()->where('id_client',$request->client_id)->whereBetween('date_operation',[$request->dateD,$request->dateF])->get();

        $client = Eleve::find($request->client_id);
        
        $total = 0 ;

        foreach ($op as $key => $operation) {
            $total+=$operation['total_a_payer'];
        }

        return view("Admin.etudiant.summary_client")->with('data', $op)->with('client',$client)->with('dateD',$request->dateD)->with('dateF',$request->dateF)->with('total',$total);
    }
    public function getMembers(Request $request) {


        $orderby = array("eleves.nom","eleves.age","email","adress","tele","classes.nom");
        $draw = $request->get('draw');
        $start = $request->get('start');
        $limit = $request->get('length');
        $filter = $request->get('search');
        $order = $request->get('order');


        $search = (isset($filter['value']))? $filter['value'] : '';

       
        // get your total no of data;
        $eleves =  Eleve::selectRaw("sold_r,sold_b,eleves.id, CONCAT(eleves.nom,' ',eleves.prenom) as nom ,  eleves.age , eleves.email , eleves.adress , eleves.tele , classes.nom as class")
         ->join('classes', 'classes.id', '=', 'eleves.id_class')
         
         ->where('eleves.nom','like','%'.$search.'%' )
         ->orWhere('prenom','like','%'.$search.'%' )
         ->orWhere('email','like','%'.$search.'%' )
         ->orWhere('adress','like','%'.$search.'%' )
         ->orWhere('tele','like','%'.$search.'%' )
         ->orWhere('classes.nom','like','%'.$search.'%' )
         ->orWhere(DB::raw('SUBSTR(MD5(eleves.id),1,10)'),$search )
        
         ->orderby($orderby[$order[0]["column"]],$order[0]["dir"])
         ->offset($start)
         ->limit($limit)->get();
       
 
         $totaleleves =  Eleve::selectRaw("eleves.id")
         ->join('classes', 'classes.id', '=', 'eleves.id_class')
         
         ->where('eleves.nom','like','%'.$search.'%' )
         ->orWhere('prenom','like','%'.$search.'%' )
         ->orWhere('email','like','%'.$search.'%' )
         ->orWhere('adress','like','%'.$search.'%' )
         ->orWhere('tele','like','%'.$search.'%' )
         ->orWhere('classes.nom','like','%'.$search.'%' )
         ->orWhere(DB::raw('SUBSTR(MD5(eleves.id),1,10)'),$search )
         ->count();
         $total_members = $totaleleves;  //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $eleves,
        );


        echo json_encode($data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
       $eleves  = Eleve::select("eleves.*")    
         ->join('classes', 'classes.id', '=', 'eleves.id_class')
         ->join('niveaux', 'niveaux.id', '=', 'classes.id_niv')
         ->join('users', 'users.id', '=', 'niveaux.id_etab')
         
         ->orderby('eleves.created_at','desc')
         ->get();

        $niveaux =Auth::user()->niveaux;

        return view('Admin.Etudiant.add')->with('eleves',$eleves)->with('niveaux',$niveaux);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->username))
        {
            \Session::flash('message_error', 'Veuillez saisir identifiant de connexion de l\'élève '); 

              return redirect()->back()->withInput(request()->all());
        }

        
        if(empty($request->password))
        {
            \Session::flash('message_error', 'Veuillez saisir mot de passe de l\'élève '); 
              return redirect()->back()->withInput(request()->all());
        }
        if(strlen($request->password)<6)
        {
            \Session::flash('message_error', 'Mot de passe d\'éléve doit contenir aux moins 6 caractères  '); 
              return redirect()->back()->withInput(request()->all());
        }



        if(empty($request->nom))
        {
            \Session::flash('message_error', 'Veuillez saisir le nom de l\'élève '); 
              return redirect()->back()->withInput(request()->all());
        }

        if(empty($request->prenom))
        {
            \Session::flash('message_error', 'Veuillez saisir le prénom de l\'élève '); 
              return redirect()->back()->withInput(request()->all());
        }

       /* if(empty($request->age) )
        {
            \Session::flash('message_error', 'Veuillez saisir date de naissance de l\'élève '); 
              return redirect()->back()->withInput(Input::all());
        }

        if(empty($request->adress))
        {
            \Session::flash('message_error', 'Veuillez saisir l\'adresse de l\'élève '); 
              return redirect()->back()->withInput(Input::all());
        }*/




        if( empty($request->tele)) 
        {
             \Session::flash('message_error', 'Veuillez saisir N° téléphone de l\'élève '); 
              return redirect()->back()->withInput(request()->all());
        }

        

        if(empty($request->email))
        {
            \Session::flash('message_error', 'Veuillez saisir email de l\'élève '); 
              return redirect()->back()->withInput(request()->all());
        }

              if($request->hasFile('logo'))
        {
            $logo =  $request->logo->getClientOriginalName();


            $request->logo->move(public_path('images/eleve/'),$logo);
            
            



                $eleve = Eleve::create([
                    'username'=>$request->username,
                    'password'=>Hash::make($request->password),
                    'nom'=>$request->nom,
                    'prenom'=>$request->prenom,
                    'age'=>$request->age,
                    'adress'=>$request->adress,
                    'tele'=>$request->tele,
                    'email'=>$request->email,
                    'id_etab'=>Auth::user()->id,
                    'id_class'=>1,
                    'img'=>$logo
                ]); 
           
        }
        else
        {
            $eleve = Eleve::create([
                'username'=>$request->username,
                'password'=>Hash::make($request->password),
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'age'=>$request->age,
                'adress'=>$request->adress,
                'tele'=>$request->tele,
                'email'=>$request->email,
                'id_etab'=>Auth::user()->id,
                'id_class'=>1,
                'img'=>'defalut.png'
            ]);  
        }


          

        \Session::flash('message', 'élève ajouter avec succès !!'); 
        
         
        $eleves  = Eleve::select("eleves.*")    
         ->join('classes', 'classes.id', '=', 'eleves.id_class')
         ->join('niveaux', 'niveaux.id', '=', 'classes.id_niv')
         ->join('users', 'users.id', '=', 'niveaux.id_etab')
         
         ->get();


        return view('Admin.Etudiant.index')->with('eleves',$eleves)->with('niveaux',Niveau::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show(Eleve $eleve)
    {
        return view('Admin.Etudiant.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \App\Professeur  $eleve
     * @return \Illuminate\Http\Response
     */
    public function edit(Eleve $eleve,$id)
    {
        $eleve =Eleve::where("id" , $id)->get()->first();
        $niveaux =Auth::user()->niveaux;
        return view('Admin.Etudiant.update')->with('eleve',$eleve)->with('niveaux',$niveaux);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Professeur  $eleve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eleve $eleve)
    {

        
        if(empty($request->username))
        {
            \Session::flash('message_error', 'Veuillez saisir login de l\'élève '); 
            return redirect()->back()->withInput(Input::all());

        }

        if(empty($request->nom))
        {
            \Session::flash('message_error', 'Veuillez saisir le nom de l\'élève ');
            return redirect()->back()->withInput(Input::all()); 

        }

        if(empty($request->prenom))
        {
            \Session::flash('message_error', 'Veuillez saisir le prénom de l\'élève '); 
            return redirect()->back()->withInput(Input::all());

        }

        /*if(empty($request->age))
        {
            \Session::flash('message_error', 'Veuillez saisir date de naissance de l\'élève '); 
            return redirect()->back()->withInput(Input::all());

        }

        if(empty($request->adress))
        {
            \Session::flash('message_error', 'Veuillez saisir l\'adresse de l\'élève '); 
            return redirect()->back()->withInput(Input::all());

        }*/

       /* if(empty($request->tele))
        {
            \Session::flash('message_error', 'Veuillez saisir N° téléphone de l\'élève '); 
            return redirect()->back()->withInput(Input::all());

        }*/

     /*   if(empty($request->email))
        {
            \Session::flash('message_error', 'Veuillez saisir email de l\'élève '); 
            return redirect()->back()->withInput(Input::all());

        }*/

  /*      if(empty($request->id_class))
        {
            \Session::flash('message', 'Veuillez choisir classe de la classe '); 
            return redirect()->back();

        }*/



        

        
         $etudiant_geted = Eleve::where("id","=",$request->id)->first();

        
        if(isset($etudiant_geted)):

            if($request->hasFile('logo'))
            {
                $logo =  $request->logo->getClientOriginalName();
                $request->logo->move(public_path('images/eleve/'),$logo);
                $etudiant_geted->img = $logo;
            }

            $etudiant_geted->username = $request->username;  
            $etudiant_geted->nom = $request->nom;  
            $etudiant_geted->prenom = $request->prenom;  
            $etudiant_geted->age = $request->age;  
            $etudiant_geted->adress = $request->adress; 
            $etudiant_geted->tele = $request->tele;  
            $etudiant_geted->email = $request->email;  
            $etudiant_geted->id_etab = Auth::user()->id;  
            $etudiant_geted->save();
        endif;

        // Sending email, sms or doing anything you want
         
        //   $this->activationService->sendActivationMail($pharmacie);
        \Session::flash('message', 'Vos informations ont été bien modifiées!!'); 
        /*return redirect('/regsterpharmacie')->with('message', 'We sent a comfirmation email to your email, please click on link inside before login');*/
        return redirect()->back();


    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Professeur  $eleve
     * @return \Illuminate\Http\Response
     */
    public function updateClasseEleve(Request $request, Eleve $eleve)
    {

        
        if(!is_numeric($request->id_class))
        {
            \Session::flash('message_update_classe_error', 'Veuillez choisir classe de la classe '); 
            return redirect()->back()->withInput(Input::all());

        }

        $etudiant_geted = Eleve::where("id","=",$request->id)->first();

  

        if(isset($etudiant_geted)):
            $etudiant_geted->id_class = $request->id_class;   
            $etudiant_geted->save();
        endif;

        // Sending email, sms or doing anything you want
         
        //   $this->activationService->sendActivationMail($pharmacie);
        \Session::flash('message_update_classe_success', 'Vos informations ont été bien modifiées!!'); 
        /*return redirect('/regsterpharmacie')->with('message', 'We sent a comfirmation email to your email, please click on link inside before login');*/
        
        return Redirect::back();


    }



    


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Professeur  $eleve
     * @return \Illuminate\Http\Response
     */
    public function updatePasswordEleve(Request $request, Eleve $eleve)
    {

        
        if(is_null($request->password) || strlen($request->password)<6)
        {
            \Session::flash('message_update_password_error', 'Mot de passe doît contenir au moins 6 caractères'); 
            return redirect()->back()->withInput(Input::all());

        }

        $etudiant_geted = Eleve::where("id","=",$request->id)->first();

        if(isset($etudiant_geted)):
            $etudiant_geted->password = Hash::make($request->password);   
            $etudiant_geted->save();
        endif;

        // Sending email, sms or doing anything you want
         
        //   $this->activationService->sendActivationMail($pharmacie);
        \Session::flash('message_update_password_success', 'Vos informations ont été bien modifiées !!'); 
        /*return redirect('/regsterpharmacie')->with('message', 'We sent a comfirmation email to your email, please click on link inside before login');*/
        
        return Redirect::back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professeur  $eleve
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Eleve::where("id","=",$id)->delete();
        
        \Session::flash('message', 'Suppression effectuée !!'); 

        return redirect()->back();
    }

    public function get_card_eleve(Request $request)
    {

       
       $eleve = Eleve::where("id","=",$request->id)->first();
        
       
        
        return view('Admin.Etudiant.card',compact('eleve'))->render();
    }


    

    public function selectAjaxClassesByNiveau(Request $request)
    {
        if($request->ajax()){

            $classes=Classe::where('id_niv',$request->id_niv)->pluck("nom","id")->all();

            $data = view('Admin.Etudiant.ajax-niveau-calsses',compact('classes'))->render();
          
            return response()->json(['options'=>$data]);
        }
    }

    public function export_pdf_card(Request $request)
    {


      
        $eleves = Eleve::where("id_class",$request->id_class)->get();

     // Send data to the view using loadView function of PDF facade
//      
//      // If you want to store the generated pdf to the server then you can use the store function
//   //   $pdf->save(storage_path().'_filename.pdf');
    //      // Finally, you can download the file using download function
    //     
    // $pdf = PDF::loadView('Admin.pdf.cards', ['eleves'=>$eleves]);
    //  return $pdf->download('Eleves_'.gmdate('Y_m_d').'.pdf');

   return view('Admin.pdf.cards', ['eleves'=>$eleves]);
   }

   public function add_sold_eleve(Request $data)
   { 
       $qte=0; 

       if ($data->sold =="") {
         
           $jsonmsg = array("msg" => "error" , "text" => "Sold est vide");
           return   response()->json($jsonmsg);
       }
       

       $Eleve =  Eleve::where("id",$data->id)->first();

        DetailSold::create([
            'id_user'=>Auth::user()->id,
            'id_eleve'=>$data->id,
            'type'=>$data->type,
            'sold'=>$data->sold,
            'remrque'=>$data->remrque,
            
        ]);
        

        if($data->type == "R")
        {
            $Eleve->sold_r += $data->sold;  
        }
        else {
            $Eleve->sold_b += $data->sold;  
        }
            $Eleve->save();

            
        $jsonmsg = array("msg" => "success" , "text" => "Operation termine avec succès");
        return   response()->json($jsonmsg);
   
   
    }


    public function etat_recharge_data(Request $data)
    {

        $detailsolds =DetailSold::selectRaw("eleves.id, CONCAT(eleves.nom,' ',eleves.prenom) as nom ,
        users.nom as user_nom,detail_solds.type,detail_solds.sold,detail_solds.created_at as date,remrque ")
        ->join('eleves', 'eleves.id', '=', 'detail_solds.id_eleve')
        ->join('users', 'users.id', '=', 'detail_solds.id_user')
        ->whereDate('detail_solds.created_at','>=',$data->dateD)
        ->whereDate('detail_solds.created_at','<=',$data->dateF)
        ->get();
        return view('Admin.Etudiant.etat.rechargedata',['detailsolds'=>$detailsolds]);
    }

}
