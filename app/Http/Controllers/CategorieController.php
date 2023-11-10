<?php

namespace App\Http\Controllers;

use App\Model\Categorie;
use App\Model\Travailleur;
use App\Model\Operation;
use App\Model\DetailOperation;
use Illuminate\Http\Request;

use DB;
use Auth;
use Carbon\Carbon;

class CategorieController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admins,travailleurs');
    }
       

    public function store(Request $request)
    {

        $this->validate($request, [
        'nom' => 'required|string|between:1,30',
          ]);


        $cats = new Categorie;

        $img=null;
        if ($request->hasFile('img'))
            {
            $file = $request->file('img');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $img = $name;
            $file->move(public_path().'/images/cat/', $name);   
        }

        $cats->id_user = Auth::user()->id;
        $cats->nom_cat = $request->nom;
        $cats->img = $img;
        $cats->type = $request->type;

        $cats->save();

        

        \Session::flash('message', 'Categorie ajoutée avec succès !!'); 

        return redirect()->back();
    }


    public function edit($id)
    {
        $cat = Categorie::find($id);

        return view('Admin.cat.edit')->with('cat',$cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prix  $prix
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cat = Categorie::find($request->id);

          $img=null;
        if ($request->hasFile('img'))
            {
            $file = $request->file('img');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
            $name = $timestamp. '-' .$file->getClientOriginalName();
          
            $file->move(public_path().'/images/cat/', $name);   
            $cat->img  = $name;
           
        $cat->nom_cat = $request->nom;
        $cat->type = $request->type;
        
        $cat->save();
    }else {
        $cat->nom_cat = $request->nom;
        $cat->type = $request->type;
        
        $cat->save();
    }

        \Session::flash('message', 'Categorie modifiée avec succès !!'); 

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prix  $prix
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Categorie::find($id);
        $cat->delete();

        \Session::flash('message', 'Categorie supprimée avec succès !!'); 

        return redirect()->back();
    }



    public function ticket(Request $data)
    {
        $num=str_random(6);
        $opiration=new Operation;
        $opiration=Operation::create([
            'id_user' => Auth::user()->id_user,
            'id_travailleur' => Auth::user()->id,
             'id_hamam' => Auth::user()->id_hamamat,
             'date_operation' => date('Y-m-d H:i:s'),
             'numtick' => $num,
             'prix_prod' => $data->dh,
         ]);

        ////////////////////////////////////////////////
        $detail_operationM=new DetailOperation;
        $opr=Operation::where('numtick',$num)->first();
        
        $detail_operationM=new DetailOperation;
        $detail_operationM=DetailOperation::create([
            'id_user' => Auth::user()->id_user,
            'id_travailleur' => Auth::user()->id,
            'id_hamamt' => Auth::user()->id_hamamat,
            'id_operation' => $opr->id,
            'type' => $data->typeM,
            'prix' => $data->prixM,
            'qte_operation' => $data->qteM,
         ]);

         $detail_operationC=new DetailOperation;
        $detail_operationC=DetailOperation::create([
            'id_user' => Auth::user()->id_user,
            'id_travailleur' => Auth::user()->id,
            'id_hamamt' => Auth::user()->id_hamamat,
            'id_operation' => $opr->id,
            'type' => $data->typeC,
            'prix' => $data->prixC,
            'qte_operation' => $data->qteC,
         ]);

        ////////////////////////////////////////////////
        if(! empty($data->optionID)){
             $detail_option = new DetailOption;
            foreach ($data->optionID as $value) {
                $detail_option=DetailOption::create([
                    'id_user' => Auth::user()->id_user,
                    'id_travailleur' => Auth::user()->id,
                    'id_hamamt' => Auth::user()->id_hamamat,
                    'id_operation' => $opr->id,
                    'id_option' => $value,
                ]);
            }
        }
       

        return 'done';
    }



} 
