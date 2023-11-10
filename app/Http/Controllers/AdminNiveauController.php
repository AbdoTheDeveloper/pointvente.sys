<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationException;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Model\Niveau;


class AdminNiveauController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admins');
  ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
    }


    
    
     public function index()
    {

        $niveaux =Niveau::all();
        return view('Admin.Niveau.index')->with('niveaux',$niveaux);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
       return view('Admin.Niveau.add');
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
    
        $userId = Auth::id();

             
        if(empty($request->Desc_niveau))
        {
            \Session::flash('message_error', 'Veuillez saisir niveau '); 
            return redirect()->back()->withInput(Input::all());
        }
        else
        {
            $Niveau = Niveau::create([
             'id_etab' =>$userId, 
             'Desc_niveau' => $request->Desc_niveau, 
            ]);    

            \Session::flash('message', 'Niveau ajouté avec succès !!'); 
        }
        
         
        $niveaux =Niveau::all();
        return view('Admin.Niveau.index')->with('niveaux',$niveaux);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show(Niveau $niveau)
    {
        return view('Admin.Niveau.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \App\Parcours  $parcours
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveau $niveau,$id)
    {
        $niveau =Niveau::where("id_etab" , Auth::user()->id)->where("id" , $id)->get()->first();
       
        return view('Admin.Niveau.update')->with('niveau',$niveau);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Parcours  $parcours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveau $niveau)
    {
        //

        $niveau_geted = Niveau::where("id","=",$request->id)->first();

        if(isset($niveau_geted)):
            $niveau_geted->Desc_niveau = $request->Desc_niveau;  
            $niveau_geted->save();
        endif;

        // Sending email, sms or doing anything you want
         
        //   $this->activationService->sendActivationMail($pharmacie);
        \Session::flash('message', 'Vos informations ont été bien modifiées !!'); 
        /*return redirect('/regsterpharmacie')->with('message', 'We sent a comfirmation email to your email, please click on link inside before login');*/
        return redirect('admin/modifier-niveau/'.$request->id.'/');

    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @param  \App\Parcours  $parcours
     * @return \Illuminate\Http\Response
     */
    public function editClassementNiveau(Request $request)
    {
        

      
            if(!is_numeric($request->idcat1))die('error; Niveau invalide ');
            if(!is_numeric($request->classementcat1))die('error; Classement doit etre un nombre numerique  !');


            $niveau_geted = Niveau::find($request->idcat1);

          
            if(isset($niveau_geted)):
                $niveau_geted->classement = $request->classementcat1;  
                $niveau_geted->save();
                die("success;");
            endif;

            die("error;Erreur inatendue");
   

    }


    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parcours  $parcours
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Niveau $niveau)
    {
        Niveau::where("id","=",$request->id)->delete();
        
        \Session::flash('message', 'Suppression effectuée !!'); 

        return redirect('admin/niveau/');

    }


}
