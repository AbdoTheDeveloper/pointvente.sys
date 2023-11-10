<?php

namespace App\Http\Controllers;

use App\Model\Opetion;
use App\Model\Hamamat;
use Illuminate\Http\Request;

use Auth;
use DB;

class OpetionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admins');
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'id_hamamat' => 'required',
        'nom_prod' => 'required|string',
        'prix_option' => 'required|numeric',
          ]);

         $opetoin = new Opetion;

        $opetoin = Opetion::create([
            'id_user'=>Auth::user()->id,
            'id_hamam'=>$request->id_hamamat,
            'nom_option'=>$request->nom_prod,
            'prix_option'=>$request->prix_option,
        ]); 

        \Session::flash('success', 'opetion avec succès !!'); 

        return redirect()->route('admin.index_opetion');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Opetion  $opetion
     * @return \Illuminate\Http\Response
     */
    public function show(Opetion $opetion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opetion  $opetion
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        $opetion = Opetion::find($id);
         $hamamats = Hamamat::all();
        return view('Admin.opetion.edit')->with('opetion',$opetion)->with('hamamats',$hamamats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Travailleur  $travailleur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $opetion = Opetion::find($request->id);
        $opetion->nom_option = $request->nom_prod;
        $opetion->id_hamam = $request->id_hamamat;
       $opetion->prix_option = $request->prix_option;
        
        $opetion->save();

        \Session::flash('success', 'travailleur avec succès !!'); 

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Travailleur  $travailleur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opetion = Opetiont::find($id);
        $opetion->delete();

        \Session::flash('success', 'travailleur a ete supprimer !!'); 

        return redirect()->back();
    }
}
