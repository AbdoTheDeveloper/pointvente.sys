<?php

namespace App\Http\Controllers;

use App\Model\Eleve;
use App\Model\Action;
use App\Model\Attachement;
use App\Model\Item_action;
use App\Model\Parcours;
use App\Model\Eleve_delegue;


use App\Model\Item;
use App\Model\Affect_cert;
use App\Model\Certificat;

use PDF;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
class EleveController  extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:eleves');
    }
     
    public function index()
    {
        $dt = Carbon::now();
        
        $date_now= $dt->toDateString();

        $eleve_delegues =Eleve_delegue::select("eleve_delegues.*")   
         ->where('id_eleve',"=", Auth::id())
         ->get();

      

        $eleve_delegue_exist =false;
        if(isset($eleve_delegues))
        {
            if($eleve_delegues->count()>0)
            {
                $eleve_delegue_exist=true;
            }
            else
            {
               $eleve_delegue_exist=false;
            }
        }
        else
        {
           $eleve_delegue_exist=false;
        }


        $actions = Auth::user()->actions()->orderBy('created_at', 'DESC')->get();
        
        $filetype = array(
                    'jpg'=>'image_x16.png',
                    'jpeg'=>'image_x16.png',
                    'png'=>'image_x16.png',
                    'gif'=>'image_x16.png',
                    'doc'=>'word_x16.png',
                    'docx'=>'word_x16.png',
                    'xls'=>'excel_x16.png',
                    'xlsx'=>'excel_x16.png',
                    'pptx'=>'powerpoint_x16.png',
                    'txt'=>'text_x16.png',
                    'zip'=>'archive_x16.png',
                    'rar'=>'archive_x16.png',
                    'pdf'=>'pdf_x16.png',
            );


        $parcours =Parcours::select("parcours.*")   
         ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
         ->where('eleves.id',"=", Auth::id())
         ->get();


 
        return view('Elev.home')
        ->with('actions',$actions)
        ->with('filetype',$filetype)
        ->with('eleveage',$this->age(Auth::user()->age)) 
        ->with('parcours',$parcours)
        ->with('eleve_delegue_exist',$eleve_delegue_exist)
        ;
    }




    public function portfeuilleCritere()
    {
        
        $parcours =Parcours::select("parcours.*")   
         ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
         ->where('eleves.id',"=", Auth::id())
         ->get();
 
        return view('Elev.exportation_portfeuille_view')->with('parcours',$parcours)->with('eleveage',$this->age(Auth::user()->age)) ;
    }


    public function certif()
    {

        $affect_cert  = Affect_cert::select("affect_certs.*")   
             ->join('eleves', 'eleves.id', '=', 'affect_certs.id_portef')
             ->join('classes', 'classes.id', '=', 'eleves.id_class')
             ->join('niveaux', 'niveaux.id', '=', 'classes.id_niv')
             ->join('users', 'users.id', '=', 'niveaux.id_etab')
             
             ->where('eleves.id',Auth::user()->id)
             ->get();
        

        return view('Elev.certif')
        ->with('eleveage',$this->age(Auth::user()->age)) 
        ->with('affect_certs',$affect_cert);
    }



public function changeCertifSearch(Request $request)
    {
        $mot_cle=$request->keyword;


        $affect_certs  = Affect_cert::select("affect_certs.*")   
             ->join('eleves', 'eleves.id', '=', 'affect_certs.id_portef')
             ->join('certificats', 'certificats.id', '=', 'affect_certs.id_cert')
             ->join('classes', 'classes.id', '=', 'eleves.id_class')
             ->join('niveaux', 'niveaux.id', '=', 'classes.id_niv')
             ->join('users', 'users.id', '=', 'niveaux.id_etab')
             
             ->where('eleves.id',Auth::user()->id)
             ->where('affect_certs.commentaire', 'like', '%' .$mot_cle.'%' )
             ->orWhere('affect_certs.mention', 'like', '%' .$mot_cle.'%' )
             ->orWhere('certificats.descript', 'like', '%' .$mot_cle.'%' )
             ->get();

     



            $data = view('Elev.reload-ajax-certif-search',compact('affect_certs'))->render();
          
            return response()->json(['options'=>$data]);
        
               
    }

 public function filertParParcour($idpar)
    {


         $actions = Auth::user()->actions()->orderBy('created_at', 'DESC')
            ->where('id_parc',$idpar)
            ->get();
             $filetype = array(
                        'jpg'=>'image_x16.png',
                        'jpeg'=>'image_x16.png',
                        'png'=>'image_x16.png',
                        'gif'=>'image_x16.png',
                        'doc'=>'word_x16.png',
                        'docx'=>'word_x16.png',
                        'xls'=>'excel_x16.png',
                        'xlsx'=>'excel_x16.png',
                        'pptx'=>'powerpoint_x16.png',
                        'txt'=>'text_x16.png',
                        'zip'=>'archive_x16.png',
                        'rar'=>'archive_x16.png',
                        'pdf'=>'pdf_x16.png',
                );
        

        $parcours =Parcours::select("parcours.*")   
         ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
         ->where('eleves.id',"=", Auth::id())
         ->get();

         
        return view('Elev.home')
        ->with('actions',$actions)
        ->with('filetype',$filetype)
        ->with('eleveage',$this->age(Auth::user()->age)) 
        ->with('parcours',$parcours)
        ->with('idpar',$idpar);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('Elev.profile');
    }

    public function AddAciont()
    {
    

         $parcours =Parcours::select("parcours.*")   
         ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
         ->where('eleves.id',"=", Auth::id())
         ->get();


        $items = Auth::user()->classe->niveau->items;

      
      return view('Elev.action.add')
      ->with('items',$items)
      ->with('parcours',$parcours);
    }

     public function Addsend(Request $request)
    {


        $validator = Validator::make($request->all(), [
           'titre' => 'required|min:3',
           'items' => 'required',
       ]);
        
       if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
       }



            $action['titre'] =  $request->titre;
            $action['type_act'] = "0";
            $action['desc_act'] = $request->desc;
            $action['date_saisie'] = Carbon::now();
            $action['id_portef'] ='0';
            $action['id_elv'] =  Auth::id();
            $action['id_classe'] =  Auth::user()->classe->id;
            $action['id_prof'] = 0;
            $action['id_parc'] = $request->parc;

             $id_act = Action::create($action)->id ;



        
     

          
        if(isset($request->items))
        {

            foreach ( $request->items as $value) {

                $item_action['id_action'] =  $id_act;
                $item_action['id_item'] = $value ;
                Item_action::create($item_action);
            }
        }
        else
        {
              \Session::flash('error', 'Aucun item choisi');
            return redirect()->back()->withInput(Input::all()); 
        }
 

         if($request->hasFile('pv')) 
         {
            foreach($request->file('pv') as $file) 
            {

                       $fichier = $file->getClientOriginalName();
                        $filename = pathinfo($fichier, PATHINFO_FILENAME);
                       $extension = pathinfo($fichier, PATHINFO_EXTENSION);
                    
                    if($file->getSize() < 10000000  )
                    {

                        $Attachement['taille_attach'] = $filename . '_' . time() . '.' . $extension;

                        $Attachement['lien_attach'] = url('/images/action/'. $Attachement['taille_attach']);
                        $Attachement['date_attach'] =Carbon::now();
                        $Attachement['type_attach'] = $extension;
                        $Attachement['id_act'] = $id_act;
                        
                        $size_fichier=$file->getSize() / 1024 / 1024;
                        $Attachement['size_fichier']=number_format($size_fichier, 2);


                        $file->move(public_path().'/images/action/',  $Attachement['taille_attach']);
                        


                        Attachement::create($Attachement);
                    }
                    else 
                    {
                           Session::flash('error'," Taile de fichier [" .$filename ."] doit être inferieur a 10MB "); 
                            return redirect()->back();
                    }
            }
        }

       
           return redirect(route('eleve.index'))->with('success', 'Votre opération est terminée avec succès');
    }

    public function changeActionSearch(Request $request)
    {
        $mot_cle=$request->keyword;
       
        if($request->ajax()){

          
            $actions= Action::select("actions.*")    
                ->join('item_actions', 'item_actions.id_action', '=', 'actions.id')
                ->join('items', 'item_actions.id_item', '=', 'items.id')
                ->join('niveaux', 'niveaux.id', '=', 'items.id_niv')
                ->join('eleves', 'eleves.id', '=', 'actions.id_elv')
                ->join('parcours', 'parcours.id', '=', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->where('actions.titre', 'like', '%' .$mot_cle.'%' )
                ->orWhere('actions.desc_act', 'like', '%' .$mot_cle.'%' )
                ->orWhere('parcours.desc_parc', 'like', '%' .$mot_cle.'%' )
                ->orWhere('parcours.type', 'like', '%' .$mot_cle.'%' )
                ->orWhere('niveaux.Desc_niveau', 'like', '%' .$mot_cle.'%' )
                ->orderBy('actions.created_at', 'DESC')
                ->get();

        //$actions = Auth::user()->actions()->orderBy('created_at', 'DESC')->get();

        $filetype = array(
                        'jpg'=>'image_x16.png',
                        'jpeg'=>'image_x16.png',
                        'png'=>'image_x16.png',
                        'gif'=>'image_x16.png',
                        'doc'=>'word_x16.png',
                        'docx'=>'word_x16.png',
                        'xls'=>'excel_x16.png',
                        'xlsx'=>'excel_x16.png',
                        'pptx'=>'powerpoint_x16.png',
                        'txt'=>'text_x16.png',
                        'zip'=>'archive_x16.png',
                        'rar'=>'archive_x16.png',
                        'pdf'=>'pdf_x16.png',
                );


        $parcours =Parcours::select("parcours.*")   
         ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
         ->where('eleves.id',"=", Auth::id())
         ->get();



            $data = view('Elev.reload-ajax-action-search',compact('actions','filetype','eleveage','parcours'))->render();
          
            return response()->json(['options'=>$data]);
        }



            
               
    }



    public function changeActionFilter(Request $request)
    {
       
       
        if($request->ajax()){

             $type_filter=$request->type_filter;

            if($type_filter=="professeur")
            {
                $actions= Action::select("actions.*")    
                ->join('item_actions', 'item_actions.id_action', '=', 'actions.id')
                ->join('items', 'item_actions.id_item', '=', 'items.id')
                ->join('niveaux', 'niveaux.id', '=', 'items.id_niv')
                ->join('eleves', 'eleves.id', '=', 'actions.id_elv')
                ->join('parcours', 'parcours.id', '=', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->where('actions.id_prof','<>',0)
                ->orderBy('actions.created_at', 'DESC')
                ->orderBy('parcours.created_at', 'ASC')
                ->get();
            }
            
            if($type_filter=="eleve")
            {
                $actions= Action::select("actions.*")    
                ->join('item_actions', 'item_actions.id_action', '=', 'actions.id')
                ->join('items', 'item_actions.id_item', '=', 'items.id')
                ->join('niveaux', 'niveaux.id', '=', 'items.id_niv')
                ->join('eleves', 'eleves.id', '=', 'actions.id_elv')
                ->join('parcours', 'parcours.id', '=', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->where('actions.id_prof', 0)
                ->orderBy('actions.created_at', 'DESC')
                ->orderBy('parcours.created_at', 'ASC')
                ->get();
            }

            if($type_filter=="tous")
            {
                $actions= Action::select("actions.*")    
                ->join('item_actions', 'item_actions.id_action', '=', 'actions.id')
                ->join('items', 'item_actions.id_item', '=', 'items.id')
                ->join('niveaux', 'niveaux.id', '=', 'items.id_niv')
                ->join('eleves', 'eleves.id', '=', 'actions.id_elv')
                ->join('parcours', 'parcours.id', '=', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->orderBy('actions.created_at', 'DESC')
                ->orderBy('parcours.created_at', 'ASC')
                ->get();
            }
            

        //$actions = Auth::user()->actions()->orderBy('created_at', 'DESC')->get();

            $filetype = array(
                            'jpg'=>'image_x16.png',
                            'jpeg'=>'image_x16.png',
                            'png'=>'image_x16.png',
                            'gif'=>'image_x16.png',
                            'doc'=>'word_x16.png',
                            'docx'=>'word_x16.png',
                            'xls'=>'excel_x16.png',
                            'xlsx'=>'excel_x16.png',
                            'pptx'=>'powerpoint_x16.png',
                            'txt'=>'text_x16.png',
                            'zip'=>'archive_x16.png',
                            'rar'=>'archive_x16.png',
                            'pdf'=>'pdf_x16.png',
            );


        $parcours =Parcours::select("parcours.*")   
         ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
         ->where('eleves.id',"=", Auth::id())
         ->get();



            $data = view('Elev.reload-ajax-action-filter',compact('actions','filetype','eleveage','parcours'))->render();
          
            return response()->json(['options'=>$data]);
        }



            
               
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_eleve()
    {
        return view('Etudiant.update');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show(Eleve $eleve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function edit(Eleve $eleve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $user = Eleve::where('id', '=',Auth::user()->id)->first();

      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'prenom' => 'required|string|max:255',
      ]);
      $attributes = $request->all();
       
     if ($request->hasFile('image'))
            {
            $file = $request->file('image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $attributes['img'] = $name;
            
            $file->move(public_path().'/images/eleve/', $name);   
            
        }
     
      $user->update($attributes);
      return redirect()->back()->with('success', 'Votre opération est terminée avec succès');
    }

    public function updatepass(Request $request)
    {


      $user = Eleve::where('id', '=',Auth::user()->id)->first();

      $this->validate($request, [
         'password' => 'confirmed|min:6',
      ]);


        if(!Hash::check($request->Ancien, $user->password) )
        {   
              
            Session::flash('error', 'Ancien mot de passe incorrecte'); 
             return redirect()->back();
        }
      
       $attributes = array();
      if(!empty($request->password)) {

         $attributes['password'] = Hash::make($request->password);
      } else {
         $attributes['password'] = $user->password;
      }
        
      $user->update($attributes);
      return redirect()->back()->with('success', 'Votre opération est terminée avec succès');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eleve $eleve)
    {
        //
    }

    function age($date) {
        $age = date('Y') - date('Y', strtotime($date));
        if (date('md') < date('md', strtotime($date))) {
        return $age - 1;
        }
        return $age;
    }



    public function changeParcourItem(Request $request)
    {

       
        if($request->ajax()){

             $items=Item::select("items.*")    
                 ->join('niveaux', 'niveaux.id', '=', 'items.id_niv')
                 ->join('parcours', 'parcours.id', '=', 'items.id_parc')
                 ->where('items.id_niv', $request->id_niveau)
                 ->where('items.id_parc', $request->id_parc)
                 ->get();
//9 / 5383

            $data = view('Prof.action.reload-ajax-classe-items',compact('items'))->render();
          
            return response()->json(['options'=>$data]);
        }
           
    }


  public function export_pdf_portfolio(Request $request)
  {

    // Fetch all customers from database
        $actions = Auth::user()->actions()->orderBy('created_at', 'DESC')->get();
        
        $filetype = array(
                    'jpg'=>'image_x16.png',
                    'jpeg'=>'image_x16.png',
                    'png'=>'image_x16.png',
                    'gif'=>'image_x16.png',
                    'doc'=>'word_x16.png',
                    'docx'=>'word_x16.png',
                    'xls'=>'excel_x16.png',
                    'xlsx'=>'excel_x16.png',
                    'pptx'=>'powerpoint_x16.png',
                    'txt'=>'text_x16.png',
                    'zip'=>'archive_x16.png',
                    'rar'=>'archive_x16.png',
                    'pdf'=>'pdf_x16.png',
            );

        if($request->parcour_id>0)
        {
            $parcours =Parcours::select("parcours.*")   
             ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
             ->where('eleves.id',"=", Auth::id())
             ->where('parcours.id',"=", $request->parcour_id)
             ->get();
        }
        else
        {
            $parcours =Parcours::select("parcours.*")   
             ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
             ->where('eleves.id',"=", Auth::id())
             ->get();
        }
        
        $array_parcours=array();
        $i=0;

        foreach($parcours as $parcour)
        {

            if($request->trier_par=="oc")
            {
                $actions = Action::select("actions.*")    
                ->join('eleves', 'eleves.id', 'actions.id_elv')
                ->join('parcours', 'parcours.id', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->where('actions.id_parc', $parcour->id)
                ->orderBy('actions.created_at', 'DESC')
                ->get();
            }
            if($request->trier_par=="p")
            {
                $actions = Action::select("actions.*")    
                ->join('eleves', 'eleves.id', 'actions.id_elv')
                ->join('parcours', 'parcours.id', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->where('actions.id_parc', $parcour->id)
                ->orderBy('parcours.created_at', 'DESC')
                ->get();
            }
            
            if($actions->count()>0)
            {
                $array_parcours[$i]['parcour']['nom'] = $parcour;
                $array_parcours[$i]['parcour']['actions'] = $actions;
            }
                
                $i++;
        }

       

        $url=url('images/eleve/profile.jpg');
    
    $eleve_certificat=Certificat::selectRaw("certificats.descript,affect_certs.commentaire,affect_certs.mention")   
             ->join('affect_certs', 'affect_certs.id_cert', '=','certificats.id') 
             ->join('eleves', 'eleves.id', '=','affect_certs.id_portef') 
             ->where('eleves.id',"=", Auth::id())
             ->get();
         //    dd(  $eleve_certificat);
//dd($array_parcours);
  /*  $certificat=null;
    if(isset($eleve_certificat))
    {
         $certificat=$eleve_certificat->img;
    }*/
   
   // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('Elev.pdf.portfolio', ['actions'=>$actions, 'url'=>$url,'user'=>Auth::user(),'filetype'=>$filetype,'parcours'=>$parcours ,'array_parcours'=>$array_parcours ,'certificat'=>$eleve_certificat]);
    // If you want to store the generated pdf to the server then you can use the store function
 //   $pdf->save(storage_path().'_filename.pdf');
    // Finally, you can download the file using download function
    return $pdf->download('portfeuille_'.Auth::user()->nom.'_'.Auth::user()->prenom.'_'.gmdate('Y_m_d').'.pdf');
  }

 public function export_word_portfolio(Request $request)
  {

    // Fetch all customers from database
        $actions = Auth::user()->actions()->orderBy('created_at', 'DESC')->get();

        $filetype = array(
                    'jpg'=>'image_x16.png',
                    'jpeg'=>'image_x16.png',
                    'png'=>'image_x16.png',
                    'gif'=>'image_x16.png',
                    'doc'=>'word_x16.png',
                    'docx'=>'word_x16.png',
                    'xls'=>'excel_x16.png',
                    'xlsx'=>'excel_x16.png',
                    'pptx'=>'powerpoint_x16.png',
                    'txt'=>'text_x16.png',
                    'zip'=>'archive_x16.png',
                    'rar'=>'archive_x16.png',
                    'pdf'=>'pdf_x16.png',
            );

        if($request->parcour_id>0)
        {
            $parcours =Parcours::select("parcours.*")   
             ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
             ->where('eleves.id',"=", Auth::id())
             ->where('parcours.id',"=", $request->parcour_id)
             ->get();
        }
        else
        {
            $parcours =Parcours::select("parcours.*")   
             ->join('eleves', 'eleves.id_etab', '=','parcours.id_etab')   
             ->where('eleves.id',"=", Auth::id())
             ->get();
        }
        
        $array_parcours=array();
        $i=0;

        foreach($parcours as $parcour)
        {

            if($request->trier_par=="oc")
            {
                $actions = Action::select("actions.*")    
                ->join('item_actions', 'item_actions.id_action', '=', 'actions.id')
                ->join('items', 'item_actions.id_item', '=', 'items.id')
                ->join('niveaux', 'niveaux.id', '=', 'items.id_niv')
                ->join('eleves', 'eleves.id', '=', 'actions.id_elv')
                ->join('parcours', 'parcours.id', '=', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->where('actions.id_parc', $parcour->id)
                ->orderBy('actions.created_at', 'DESC')
                ->get();
            }
            if($request->trier_par=="p")
            {
                $actions = Action::select("actions.*")    
                ->join('item_actions', 'item_actions.id_action', '=', 'actions.id')
                ->join('items', 'item_actions.id_item', '=', 'items.id')
                ->join('niveaux', 'niveaux.id', '=', 'items.id_niv')
                ->join('eleves', 'eleves.id', '=', 'actions.id_elv')
                ->join('parcours', 'parcours.id', '=', 'actions.id_parc')
                ->where('actions.archive', '0')
                ->where('actions.id_elv', Auth::id())
                ->where('actions.id_parc', $parcour->id)
                ->orderBy('parcours.created_at', 'DESC')
                ->get();
            }
            
            if($actions->count()>0)
            {
                $array_parcours[$i]['parcour']['nom'] = $parcour;
                $array_parcours[$i]['parcour']['actions'] = $actions;
            }
                
                $i++;
        }

       

        $url=url('images/eleve/profile.jpg');
    
    $eleve_certificat=Certificat::select("certificats.*")   
             ->join('affect_certs', 'affect_certs.id_cert', '=','certificats.id') 
             ->join('eleves', 'eleves.id', '=','affect_certs.id_portef') 
             ->where('eleves.id',"=", Auth::id())
             ->get()
             ->first();

    $certificat=null;
    if(isset($eleve_certificat))
    {
         $certificat=$eleve_certificat->img;
    }
   
  
    $data = view('Elev.pdf.portfolioword',['actions'=>$actions, 'url'=>$url,'user'=>Auth::user(),'filetype'=>$filetype,'parcours'=>$parcours ,'array_parcours'=>$array_parcours ,'certificat'=>$certificat])->render();
          
            return response()->json(['word'=>$data,'name'=>Auth::user()->nom.'_'.Auth::user()->prenom.'_'.gmdate('Y_m_d').'.doc']);
  }

  
}
