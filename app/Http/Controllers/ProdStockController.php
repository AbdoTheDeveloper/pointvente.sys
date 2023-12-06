<?php

namespace App\Http\Controllers;

use App\Model\ProdStock;
use App\Model\Prod;
use App\Model\StockOperation;
use App\Model\Categorie;

use Illuminate\Http\Request;

use Auth;

class ProdStockController extends Controller
{

public function __construct()
    {
        $this->middleware('auth:admins,travailleurs');
    }

    public function index($id)
    {
        $prods = ProdStock::selectRaw('prod_stocks.id as iddetail,prod_stocks.*,prods.*')
        -> where('id_operationStock',$id)
        ->join('prods','prods.id','prod_stocks.id_prod')
        ->get();       
        return view("Admin.stock.detail.index",['prods'=>$prods,"id"=>$id]);
    }


    public function get_articles_stock(Request $data)
    {
        $prods = Prod::where('id_cat',$data->id)->get();
        return response()->json(['prods'=>$prods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prodStockGet(Request $data)
    {
        $prods = ProdStock::where('id_operationStock',$data->id)
                ->join('prods','prods.id','prod_stocks.id_prod')
                ->get();

         return response()->json(['prods'=>$prods]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
         $operationStock = new StockOperation;
         $operationStock->id_user = Auth::user()->id;
         $operationStock->remarque = $request->remarque;
         $operationStock->id_frns = $request->id_frns;
         $operationStock->date_opt = $request->date_opt;
         $operationStock->save();

        foreach ($request->operation as $key => $value) { 
            $stock = new ProdStock;
            $stock->id_user = Auth::user()->id;
            $stock->id_operationStock = $operationStock->id;
            $stock->id_prod = $value['Prod'];
            $stock->qteEntrer = $value['Quantité'];
            $stock->prixEntre = $value['Prix'];
            $stock->save();
            $prod = Prod::where('id',$value['Prod'])->first();
            $qte=$prod->qte;
            $prod->qte=$qte+$value['Quantité'];
            $prod->save();
        }

        return 'done';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProdStock  $prodStock
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        $cats = Categorie::all();
        return view('Admin.stock.detail.add',["id"=>$id,"cats"=>$cats]);
    }
    public function save(Request $request)
    {

        // dd($request->all()) ; 
        foreach( $request->operation as $operation){
            $stock = new ProdStock;
            $stock->id_user = Auth::user()->id;
            $stock->id_operationStock = $request->id_operationStock;
            $stock->id_prod = $operation['Prod'];
            $stock->qteEntrer = $operation['Quantité'];
            $stock->prixEntre = $operation['Prix'];
            $stock->save();
            $prod = Prod::where('id', $operation['Prod'])->first();
            $qte=$prod->qte;
            $prod->qte=$qte+ $operation['Quantité'];
            $prod->save();

        }
        
            return redirect(route('admin.detail.stock.index',['id' =>$request->id_operationStock]));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProdStock  $prodStock
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdStock $prodStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProdStock  $prodStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdStock $prodStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProdStock  $prodStock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProdStock::where("id","=",$id)->delete();
        
        \Session::flash('message', 'Suppression effectuée !!'); 

        return redirect()->back();

    }
}
