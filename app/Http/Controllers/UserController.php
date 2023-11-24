<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use App\Model\Travailleur;
use App\Model\Classe;
use App\Model\Eleve;
use App\Model\Niveau;
use File;
use App\Model\Operation;
use App\Model\DetailOperation;
use App\Model\Categorie;
use App\Model\Prod;
use App\Model\Operation_prod;
use App\Model\Fornisseur;

use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;



use Redirect;

class UserController  extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admins');
    }
     




    public function index()
    {
      
        $eleves  = Eleve::where('id_etab', Auth::id())
         ->get();

        $eleves = $eleves->count();

        $niveaus  = Prod::all()->count();




        

         $eleves_arr  = Eleve::where('id_etab', Auth::id())
         ->orderBy('id','DESC')
         ->take(5)
         ->get();
        

         
        $classes_arr = Prod::where('qte','<=','qte_alert')->get();
        // dd() ; 

        $classes = Travailleur::all()->count();


        $trav  = Travailleur::select("travailleurs.*")    
         ->where('travailleurs.id_user', Auth::id())
         ->get();
        
        

        return view('Admin.index')
                ->with('eleves',$eleves)
                ->with('eleves_arr',$eleves_arr)
                ->with('classes',$classes)
                ->with('classes_arr',$classes_arr)
                ->with('travs',$trav)
                ->with('niveaus',$niveaus)
                
                ;
    }


    public function all()
    {
       $users  = User::select("users.*")    
       ->where('id',"!=", Auth::id())
         ->get();
        return view('Admin.User.index')->with('users',$users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.User.add');
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
            \Session::flash('message_error', 'Veuillez saisir login de le utilisateur '); 
            return redirect()->back()->withInput(Input::all());
        }


        if(empty($request->password))
        {
            \Session::flash('message_error', 'Veuillez saisir le mot de passe de le utilisateur '); 
              return redirect()->back();
        }
        if(strlen($request->password)<6)
        {
            \Session::flash('message_error', 'Mot de passe doit contenir aux moins 6 caractères  '); 
              return redirect()->back();
        }

        if(empty($request->nom))
        {
            \Session::flash('message_error', 'Veuillez saisir le nom de le utilisateur '); 
            return redirect()->back()->withInput(Input::all());
        }

       


        if(empty($request->grad))
        {
            \Session::flash('message_error', 'Veuillez saisir le grade de le utilisateur '); 
            return redirect()->back()->withInput(Input::all());
        }

        if(empty($request->email))
        {
            \Session::flash('message_error', 'Veuillez saisir l\'email de le utilisateur '); 
            return redirect()->back()->withInput(Input::all());
        }

        

        if($request->hasFile('logo'))
        {
            $logo =  $request->logo->getClientOriginalName();
            $request->logo->move(public_path('images/user/'),$logo);
          
                $user = User::create([
                    'username'=>$request->username,
                    'nom' => $request->nom,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'tele' => $request->tele,
                    'logo' => $logo,
                    'grad' => $request->grad,
                    'p_frns' => $request->p_frns,
                    'p_eleve' => $request->p_eleve,
                    'p_trav' => $request->p_trav,
                    'p_stock' => $request->p_stock,
                    'p_art' => $request->p_art,
                    'p_cat' => $request->p_cat,
                    'p_class' => $request->p_class,
                    'p_niv' => $request->p_niv,
                    'p_recette' => $request->p_recette,
                    'p_para' => $request->p_para,
                    'p_save' => $request->p_save,
                    'p_users' => $request->p_users,
                ]); 

        }
        else
        {
                $user = User::create([
                    'username'=>$request->username,
                    'nom' => $request->nom,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'tele' => $request->tele,
                    'logo' => 'defalut.png',
                    'grad' => $request->grad,
                    'p_frns' => $request->p_frns,
                    'p_eleve' => $request->p_eleve,
                    'p_trav' => $request->p_trav,
                    'p_stock' => $request->p_stock,
                    'p_art' => $request->p_art,
                    'p_cat' => $request->p_cat,
                    'p_class' => $request->p_class,
                    'p_niv' => $request->p_niv,
                    'p_recette' => $request->p_recette,
                    'p_para' => $request->p_para,
                    'p_save' => $request->p_save,
                    'p_users' => $request->p_users,
                ]); 

        }



        \Session::flash('message', 'user ajoutée avec succès!!'); 
        
         
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Admin.User.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \App\Professeur  $eleve
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,$id)
    {
        $user =User::where("id" , $id)->get()->first();
        return view('Admin.User.update')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Professeur  $eleve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        
        if(empty($request->username))
        {
            \Session::flash('message_error', 'Veuillez saisir login  de le utilisateur '); 
             return Redirect::back();

        }
      

        if(empty($request->nom))
        {
            \Session::flash('message_error', 'Veuillez saisir le nom  de le utilisateur ');
             return Redirect::back();

        }

       

        if(empty($request->grad))
        {
            \Session::flash('message_error', 'Veuillez saisir le grade de le utilisateur '); 
             return Redirect::back();

        }


        if(empty($request->email))
        {
            \Session::flash('message_error', 'Veuillez saisir l\'email de le utilisateur '); 
            return Redirect::back();

        }

        
         $user_geted = User::where("id","=",$request->id)->first();

        
        if(isset($user_geted)):

            if($request->hasFile('logo'))
            {
                $logo =  $request->logo->getClientOriginalName();
                $request->logo->move(public_path('images/user/'),$logo);
                $user_geted->logo = $logo;
            }

            $user_geted->username = $request->username ;
            $user_geted->nom = $request->nom ;
            $user_geted->email = $request->email ;
            $user_geted->tele = $request->tele ;
            $user_geted->grad = $request->grad ;
            $user_geted->p_frns = $request->p_frns ;
            $user_geted->p_eleve = $request->p_eleve ;
            $user_geted->p_trav = $request->p_trav ;
            $user_geted->p_stock = $request->p_stock ;
            $user_geted->p_art = $request->p_art ;
            $user_geted->p_cat = $request->p_cat ;
            $user_geted->p_class = $request->p_class ;
            $user_geted->p_niv = $request->p_niv ;
            $user_geted->p_recette = $request->p_recette ;
            $user_geted->p_para = $request->p_para ;
            $user_geted->p_save = $request->p_save ;
            $user_geted->p_users = $request->p_users ;  
            $user_geted->save();

        endif;

        // Sending email, sms or doing anything you want
         
        //   $this->activationService->sendActivationMail($pharmacie);
        \Session::flash('message', 'Vos informations ont été bien modifiées !!'); 
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
    public function updatePassworduser(Request $request, User $user)
    {

        

        if(empty($request->password))
        {
            \Session::flash('message_update_password_error', 'Veuillez saisir le mot de passe de le utilisateur '); 
              return redirect()->back();
        }
        if(strlen($request->password)<6)
        {
            \Session::flash('message_update_password_error', 'Mot de passe doit contenir aux moins 6 caractères  '); 
              return redirect()->back();
        }


        $user_geted = User::where("id","=",$request->id)->first();

        if(isset($user_geted)):
            $user_geted->password = Hash::make($request->password);   
            $user_geted->save();
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
    public function destroy(Request $request,User $user)
    {
        User::where("id","=",$request->id)->delete();
        
        \Session::flash('message', 'Suppression effectuée !!'); 

        return redirect()->back();
    }


    
    public function index_recette()
    {
         $travailleurs = Travailleur::all();
        return view('Admin.recette.index')->with('travailleurs',$travailleurs);
    }

    public function index_travailleur()
    {
        $travailleurs = Travailleur::all();
        return view('Admin.Trav.index')->with('travailleurs',$travailleurs);
    } 

    public function create_travailleur()
    {
        return view('Admin.Trav.add');
    }

   
    public function create_prodStock()
    {
        $cats = Categorie::all();
        $fournisseurs = Fornisseur::all();
        return view('Admin.stock.add')->with('cats',$cats)->with('fournisseurs',$fournisseurs);
    }

    

    public function create_cat()
    {
        return view('Admin.cat.add_cat');
    }

      public function index_cat()
    {
        $cats = Categorie::all();
        return view('Admin.cat.index_cat')->with('cats',$cats);
    }

      public function index_operationdetail_prod()
    {
        $operation_prods = Operation_prod::all();
        return view('Admin.prod.prod_operation')->with('operation_prods',$operation_prods);
    }

    public function create_fournisseur()
    {
        return view('Admin.fournisseur.add');
    }

      public function index_fournisseur()
    {
        $fournisseurs = Fornisseur::all();
        return view('Admin.fournisseur.index')->with('fournisseurs',$fournisseurs);
    }

   

     public function create_type()
    {
        return view('Admin.type.add');
    }

    


}
