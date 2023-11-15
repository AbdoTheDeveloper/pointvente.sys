<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationException;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Model\Classe;
use App\Model\Niveau;

class AdminClasseController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admins');
         ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
    }


   

    
     public function index()
    {

        $classe =Classe::select("classes.*")
         ->join('niveaux', 'niveaux.id', '=', 'classes.id_niv')    
         ->join('users', 'users.id', '=', 'niveaux.id_etab')
         ->get();

        return view('Admin.Classe.index')->with('classes',$classe);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
       $niveaux =Niveau::all();
       return view('Admin.Classe.add')->with('niveaux',$niveaux);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

        

        if(empty($request->nom))
        {
            \Session::flash('message_error', 'Veuillez saisir le nom de la classe '); 
            return redirect()->back()->withInput($request->all());
        }
        if(empty($request->nbre_elev))
        {
            \Session::flash('message_error', 'Veuillez saisir le nombre d\'éléve  de la classe '); 
              return redirect()->back()->withInput($request->all());
        }

        if(empty($request->id_niv))
        {
            \Session::flash('message_error', 'Veuillez choisir le niveau de la classe '); 
              return redirect()->back()->withInput($request->all());
        }

        $classe = Classe::create([
         'nom' =>$request->nom, 
         'nbre_elev' => $request->nbre_elev, 
         'id_niv' =>$request->id_niv
        ]);    

        \Session::flash('message', 'Classe ajoutée avec succès !!'); 
        
         
        $classes =Classe::all();
        return view('Admin.Classe.index')->with('classes',$classes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        return view('Admin.Classe.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \App\Parcours  $parcours
     * @return \Illuminate\Http\Response
     */
    public function edit(Classe $classe,$id)
    {
        $classe =Classe::where("id" , $id)->get()->first();
        
        $niveaux =Niveau::all();
       
        return view('Admin.Classe.update')->with('classe',$classe)->with('niveaux',$niveaux);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Parcours  $parcours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveau $classe)
    {
        //

        $classe_geted = Classe::where("id","=",$request->id)->first();

        if(isset($classe_geted)):
            $classe_geted->nom = $request->nom;  
            $classe_geted->nbre_elev = $request->nbre_elev;  
            $classe_geted->id_niv = $request->id_niv;  
            $classe_geted->save();
        endif;

        // Sending email, sms or doing anything you want
         
        //   $this->activationService->sendActivationMail($pharmacie);
        \Session::flash('message', 'Vos informations ont été bien modifiées !!'); 
        /*return redirect('/regsterpharmacie')->with('message', 'We sent a comfirmation email to your email, please click on link inside before login');*/
        return redirect('admin/modifier-classe/'.$request->id.'/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parcours  $parcours
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Classe $classe)
    {
        Classe::where("id","=",$request->id)->delete();
        
        \Session::flash('message', 'Suppression effectuée !!'); 

        return redirect('admin/classes/');

    }


}
