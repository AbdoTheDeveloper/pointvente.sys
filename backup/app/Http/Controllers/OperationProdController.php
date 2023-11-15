<?php

namespace App\Http\Controllers;

use App\Model\Operation_prod;
use App\Model\Prod;
use App\Model\Hamamat;
use App\Model\Detail_operationProd;

use Illuminate\Http\Request;

use Auth;
use DB;

class OperationProdController extends Controller
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
        $prods = Prod::all();
        return view('Admin.prod.operation')->wiht('prods',$prods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {

        $this->validate($request, [
        'remarque' => 'required|string',
        'date' => 'required',
          ]);


        $operation_prod = new Operation_prod;

        $operation_prod = Operation_prod::create([
            'id_user'=>Auth::user()->id,
            'remarque'=>$data->remarque,
            'date'=>$data->date,
        ]); 


        $detail_operationProd = new Detail_operationProd;

        foreach ($data->operation as $key => $value) {
            $detail_operationProd = Detail_operationProd::create([
                'id_user'=>Auth::user()->id,
                'id_hamamt'=>$value['Hamam'],
                'id_operationProd'=>$operation_prod->id,
                'prod'=>$value['Prod'],
                'qte'=>$value['Qte'],
            ]);
        }

        \Session::flash('success', 'hamamt avec succès !!'); 

        return 'done';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operation_prod  $operation_prod
     * @return \Illuminate\Http\Response
     */
    public function show(Operation_prod $operation_prod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operation_prod  $operation_prod
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation_prod $operation_prod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operation_prod  $operation_prod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation_prod $operation_prod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operation_prod  $operation_prod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation_prod $operation_prod)
    {
        //
    }
}
