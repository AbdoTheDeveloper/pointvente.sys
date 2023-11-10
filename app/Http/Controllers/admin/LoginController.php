<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Travailleur;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
class LoginController extends Controller
{

    protected $redirectTo = "admin/index";


    public function __construct()
    {

        $this->middleware('guest:admins', ['except' => ['logout'] ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        $travs = Travailleur::all();

        return  view('Admin.auth.login')->with('travs', $travs);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {

        //attempt to log ther user in
        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){


            return redirect(route('admin.index'));
        }


        $errors = new MessageBag(['password' => ['Username and/or password invalid.']]);
        // if unsuccessful, then redirect back to login with the form date
       return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'remember'));
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        return redirect(route("admin.ShowLogin"));
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
