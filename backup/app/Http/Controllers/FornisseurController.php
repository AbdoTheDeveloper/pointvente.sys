<?php

namespace App\Http\Controllers;

use App\Model\Fornisseur;
use Illuminate\Http\Request;

use Auth;
use DB;

class FornisseurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
        //
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


    public function store(Request $request)
    {

       
        $this->validate($request, [
        'nom_frns' => 'required|string|between:1,30',
        'tel' => 'required|numeric',
        'email' => 'required|email',
      
        
          ]);
       
        $frns = new Fornisseur;
        $frns->id_user = Auth::user()->id;
        $frns->nom_frns = $request->nom_frns;
        $frns->tel = $request->tel;
        $frns->email = $request->email;
        $frns->adress = $request->adress;
        $frns->remarque = $request->remarque;
        $frns->save();

        \Session::flash('message', 'Fournisseur ajouté avec succès !!'); 

        return redirect()->back();
    }


    public function show(Fornisseur $fornisseur)
    {
        //
    }


    public function edit($id)
    {
        $fournisseur = Fornisseur::find($id);
        return view('Admin.fournisseur.edit')->with('fournisseur',$fournisseur);
    }


    public function update(Request $request)
    {
        $fournisseur = Fornisseur::find($request->id);
        $fournisseur->nom_frns = $request->nom_frns;
        $fournisseur->tel = $request->tel;
        $fournisseur->email = $request->email;
        $fournisseur->adress = $request->adress;
        $fournisseur->remarque = $request->remarque;
        $fournisseur->update();

        \Session::flash('message', 'Fournisseur modifie avec succès !!'); 

        return redirect()->route('admin.index_fournisseur');
    }

    public function destroy($id)
    {
        $frns = Fornisseur::find($id);
        $frns->delete();

        \Session::flash('message', 'Fournisseur supprimé avec succès !!'); 

        return redirect()->back();
    }
}
