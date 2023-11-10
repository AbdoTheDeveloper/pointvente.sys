<?php

namespace App\Http\Controllers\travailleur;

use App\Http\Controllers\Controller;
use App\Model\Travailleur;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    protected $redirectTo = "trav.index";


    public function __construct()
    {

        $this->middleware('guest:travailleurs', ['except' => ['logout'] ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
       $travs = Travailleur::all();
        return  view('Trav.auth.login')->with('travs', $travs);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {


//dd(bcrypt($request->password));
        //attempt to log ther user in

        $trav = Travailleur::all();

        foreach ($trav as $t) {
       
            if(Hash::check($request->password, $t->password)) {
                session()->flush();
                if (Auth::guard('travailleurs')->attempt(['username' => $t->username, 'password' => $request->password], $request->remember)){
                    //dd($request->username);
                    $request->session()->regenerate();
                    return redirect(route('trav.index'));
                }
        
            }
        }



 //dd($request->username.'eeeee');
        $errors = new MessageBag(['password' => ['Username and/or password invalid.']]);
        // if unsuccessful, then redirect back to login with the form date
       return redirect()->back()->withErrors($errors)->withInput($request->only('username', 'remember'));
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        Auth::guard('travailleurs')->logout();
        Session::flush();
        return redirect(route("trav.ShowLogin"));
    }

   protected function loginValidation($request)
    {
        $rules = array(
          'username'      => 'required|max:255|unique:users',
          'password'   => 'required|min:6|confirmed',
    );
        $this->validate( $request , $rules);
    }


}
