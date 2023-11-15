<?php

namespace App\Http\Controllers\travailleur;

use App\Mail\VerificationMail;
use App\Model\Candidat;
use App\Model\Parametrage;
use App\Http\Controllers\Controller;
use App\Model\VerificationCandidat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use DB;


class RegisterController extends Controller {
   /*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */

   use RegistersUsers;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = '/home';

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct() {
      $this->middleware('guest:candidats');
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data) {
      return Validator::make($data, [
         'verif_bac' => 'required',
         'nom' => 'required|string|max:255|min:3',
         'prenom' => 'required|string|max:255|min:3',
         'username' => 'required|string|max:255|unique:candidats',
         'pays' => 'required|string|max:255|min:3',
         'email' => 'required|string|email|max:255|unique:candidats',
         'password' => 'required|string|min:6|confirmed',
        
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array $data
    * @return \App\User
    */
   protected function create(Request $data) {


         

      //   $parametrage  = Parametrage::first();
   

      // // $timezone = 'Europe/London'; 
      //   $date = new DateTime();
       
      // // $localtime = $date->format('Y-m-d h:i:s');
      

      //    $dateover = strtotime($parametrage->date_ouvert_inscription);
      //  // dd("date base de donner".$parametrage->date_ouvert_inscription);

      //   //dd("date server:".$localtime."-"."date base de donner".$parametrage->date_ouvert_inscription);

      //     var_dump($dateover < $date);



      //     if (!(var_dump($dateover < $date)  )) {

      //      dd(" autoriser");

      //     } else {

      //      dd("non autoriser");

      //     }






          
       $validator = $this->validator($data->all());


        if($validator->fails()){
          
              return redirect()->back()->with('errors', $validator->messages())->withInput($data->all());
          }


      $user = Candidat::create([
         'nom' => $data['nom'],
         'prenom' => $data['prenom'],
         'username' => $data['username'],
         'email' => $data['email'],
         'pays' => $data['pays'],
         'type' => $data['type'],
         'password' => Hash::make($data['password']),
         'created_by' => $data['created_by'],
         'expires_at' => $data['expires_at'],
      ]);

      $verifyUser = VerificationCandidat::create([
         'candidat_id' => $user->id,
         'token' => str_random(40)
      ]);

      Mail::to($user->email)->send(new VerificationMail($user));

    
      return redirect(route('candidat.login'))->with('status', 'Nous vous avons envoyé un code d’activation. Vérifiez votre email et cliquez sur le lien pour vérifier.');
   }

   public function verifyUser($token) {
      $VerificationCandidat = VerificationCandidat::where('token', $token)->first();
      if(isset($VerificationCandidat)) {
         $user = $VerificationCandidat->Candidat;
         if(!$user->verified) {
            $VerificationCandidat->Candidat->verified = 1;
            $VerificationCandidat->Candidat->save();
            $status = "Votre e-mail est vérifié. Vous pouvez maintenant vous connecter.";
         } else {
            $status = "Votre e-mail est déjà vérifié. Vous pouvez maintenant vous connecter.";
         }
      } else {
         return redirect(route('candidat.login'))->with("warning", "Désolé, votre email ne peut pas être identifié.");
      }

 
      return redirect(route('candidat.login'))->with('status', $status);
   }

   protected function registered(Request $request, $user)
   {
      $this->guard('candidats')->logout();
      return redirect('/connexion')->with('status', 'Nous vous avons envoyé un code d’activation. Vérifiez votre email et cliquez sur le lien pour vérifier.');
   }





   public function showRegistrationForm()
    {
       
        $parametrage  = Parametrage::first();
        $pays=DB::table('country')->get();
        return  view('Candidat.auth.register')->with('parametrage', $parametrage)->with('pays', $pays);
    }

    
}
