<?php

namespace App\Http\Controllers;

use App\Model\Prod;
use App\Model\ProdStock;
use App\Model\StockOperation;
use Illuminate\Http\Request;

use DB;
use Auth;

class StockOperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index_prodStock()
    {

        $date = date('Y') . '-' . date('m');
        $stocks = StockOperation::selectRaw("stock_operations.id,users.nom,nom_frns,stock_operations.remarque,stock_operations.date_opt")
            ->join('users', 'users.id', '=', 'stock_operations.id_user')
            ->join('fornisseurs', 'fornisseurs.id', '=', 'stock_operations.id_frns')
            ->whereRaw("DATE_FORMAT(stock_operations.date_opt,'%Y-%m')='" . $date . "'")
            ->get();

        return view("Admin.stock.index", ['stocks' => $stocks]);
    }


    public function StockOperationGet(Request $data)
    {

        if ($data->anne != 0) {
            if ($data->mois != 0) {
                $date = $data->anne . "-" . $data->mois;

                $stocks = StockOperation::selectRaw("stock_operations.id,users.nom,nom_frns,stock_operations.remarque,stock_operations.date_opt")
                    ->join('users', 'users.id', '=', 'stock_operations.id_user')
                    ->join('fornisseurs', 'fornisseurs.id', '=', 'stock_operations.id_frns')
                    ->whereRaw("DATE_FORMAT(stock_operations.date_opt,'%Y-%m')='" . $date . "'")
                    ->get();
            } else {
                $stocks = StockOperation::selectRaw("stock_operations.id,users.nom,nom_frns,stock_operations.remarque,stock_operations.date_opt")
                    ->join('users', 'users.id', '=', 'stock_operations.id_user')
                    ->join('fornisseurs', 'fornisseurs.id', '=', 'stock_operations.id_frns')
                    ->whereRaw("YEAR(stock_operations.date_opt)='" . $data->anne . "'")
                    ->get();
            }
        } else {
            $stocks = StockOperation::selectRaw("stock_operations.id,users.nom,nom_frns,stock_operations.remarque,stock_operations.date_opt")
                ->join('users', 'users.id', '=', 'stock_operations.id_user')
                ->join('fornisseurs', 'fornisseurs.id', '=', 'stock_operations.id_frns')
                ->get();
        }

        return view("Admin.stock.index", ['stocks' => $stocks]);
    }
    public function destroy($id)
    {
        $opetion = StockOperation::find($id);
        $op_details = ProdStock::where('id_operationStock', $id)->get();


        foreach ($op_details as $op) {
            $article = Prod::find($op['id_prod']);
            $article->qte = $article->qte - $op['qteEntrer'];
            $article->update();
            $op->delete();
        }

        $opetion->delete();

        \Session::flash('success', 'Stock a ete supprimer !!');

        return redirect()->back();
    }
}
