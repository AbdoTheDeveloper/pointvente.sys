<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationException;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Redirect;

class AdminEtablissementController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admins');
         ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
    }

    public function index()
    {
        $etablissement = User::where("id" , Auth::user()->id)->get()->first();    
        return view('Admin.Etablissement.index')->with('etablissement',$etablissement);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Admin.Etablissement.add');
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
    public function show(Etablissement $etablissement)
    {
        return view('Admin.Etablissement.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \App\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function edit(Etablissement $etablissement)
    {
        return view('Admin.Etablissement.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $etablissement_geted = User::where("id","=",$request->id)->first();

        if(empty($request->nom))
        {
            \Session::flash('message_error', 'Veuillez saisir la dénomination de l\'établissement '); 
            return redirect()->back()->withInput(Input::all()); 
        }

        if(isset($etablissement_geted)):

            $etablissement_geted->nom = $request->nom;
            $etablissement_geted->tele = $request->tele;
            $etablissement_geted->email = $request->email;
            $etablissement_geted->email = $request->email;
            $etablissement_geted->msg = $request->msg;
            if($request->hasFile('logo'))
            {
                $logo =  $request->logo->getClientOriginalName();
                $request->logo->move(public_path('user/'),$logo);
                $etablissement_geted->logo = $logo;
            }

            $etablissement_geted->save();

        endif;
        
        return redirect()->back(); 
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request)
    {

   
        $etablissement_geted = User::where("id","=",Auth::user()->id)->first();
        $error=false;
        
        if(!isset($request->ancien_password))
        {
             $error=true;
            \Session::flash('message_error_password', 'Veuillez saisir votre ancien mot de passe !!'); 
            return redirect()->back()->withInput(Input::all()); 
        }

        if(!isset($request->nouveau_password) )
        {
             $error=true;
            \Session::flash('message_error_password', 'Veuillez saisir votre nouveau mot de passe !!'); 
            return redirect()->back()->withInput(Input::all()); 
        }

        if(!isset($request->confirm_password))
        {
            $error=true;
            \Session::flash('message_error_password', 'Veuillez confirmer votre nouveau mot de passe !!'); 
            return redirect()->back()->withInput(Input::all()); 
        }

        if(strlen($request->nouveau_password)<6)
        {
             $error=true;
            \Session::flash('message_error_password', 'Nombre de caractère de mot de passe doit être au minimum 6 caractère  !!'); 
            return redirect()->back()->withInput(Input::all()); 
        }

        if(strlen($request->confirm_password)<6)
        {
            $error=true;
            \Session::flash('message_error_password', 'Nombre de caractère de mot de passe doit être au minimum 6 caractère  !!'); 
            return redirect()->back()->withInput(Input::all()); 
        }


        if(!Hash::check($request->ancien_password, $etablissement_geted->password))
        {
             $error=true;
            \Session::flash('message_error_password', 'Mot de passe incorrect !!'); 
        }
        
        if($request->confirm_password != $request->nouveau_password )
        {
            $error=true;
            \Session::flash('message_error_password', 'Les mots de passe ne sont pas identiques !!'); 
            return redirect()->back()->withInput(Input::all()); 
        }

        if($error==false)
        {
            $etablissement_geted->password = Hash::make($request->nouveau_password);  

            $etablissement_geted->save();

            \Session::flash('message_password', 'Votre mot de passe a été modifier !!'); 
            return redirect()->back()->withInput(Input::all()); 
        }
       
        /*return redirect('/regsterpharmacie')->with('message', 'We sent a comfirmation email to your email, please click on link inside before login');*/
        return redirect()->back()->withInput(Input::all()); 
    }




      

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }


}
