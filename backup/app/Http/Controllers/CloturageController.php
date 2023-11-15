<?php

namespace App\Http\Controllers;

use App\Config;
use App\Model\Cloturage;
use App\Model\Operation;
use App\Model\DetailOperation;
use Illuminate\Http\Request;
use GuzzleHttp;

use Auth;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB as FacadesDB;

class CloturageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins,travailleurs');
    }


    public function cloturage()
    {



        $operation = Operation::where('id_trav', '=', Auth::user()->id)
            ->whereNull("cloturage")->count();

        // $operations = Operation::where(['operations.id_trav','=',Auth::user()->id],['operations.statut','=',1]
        //,['operations.cloturage','=','NULL'])
        //    ->select('operations.*','operations.id as id_operation')->toSql();


        $operations = DB::select(DB::raw('SELECT operations.*,operations.id AS id_operation FROM operations WHERE operations.id_trav = ' . Auth::user()->id . ' AND operations.statut = 1 AND operations.cloturage IS NULL'));


        $montant = 0;
        $montant_espece = 0;
        $montant_carte = 0;
        $montant_offert = 0;
        $montant_compte = 0;
        if ($operation == 0) {
            return '';
        }

        foreach ($operations as $key) {

            $montant = $montant + ($key->total_a_payer );
            $montant_espece = $key->methode_paie == 'espece' ? ($montant_espece + ($key->total_a_payer )) : $montant_espece;
            $montant_carte = $key->methode_paie == 'carte-bancaire' ? ($montant_carte + ($key->total_a_payer )) : $montant_carte;
            $montant_offert = $key->methode_paie == 'offert' ? ($montant_offert + ($key->total_a_payer )) : $montant_offert;
            $montant_compte = $key->methode_paie == 'en-compte' ? ($montant_compte + ($key->total_a_payer )) : $montant_compte;
        }
        return [
            "montant" =>round((float)$montant,2),
            "montant_espece" => round((float)$montant_espece,2),
            "montant_carte" => round((float)$montant_carte,2),
            "montant_compte" => round((float)$montant_compte,2),
            "montant_offert" => round((float)$montant_offert,2),
        ];
    }

    public function cloturage_confirm()
    {

        $operation = Operation::where('id_trav', '=', Auth::user()->id)
            ->where('statut', '1')
            ->whereNull("cloturage")->count();
        $operations = Operation::where('operations.id_trav', '=', Auth::user()->id)
            ->where('statut', '1')
            ->whereNull("cloturage")
            ->select('operations.*', 'operations.id as id_operation')
            ->get();
        $montant = 0;
        $espece = 0;
        $carte = 0;
        $offert = 0;
        $compte = 0;

        foreach ($operations as $key => $value) {
            $montant = $montant +  ($value->total_a_payer - $value->total_a_payer * $value->remise / 100);


            if ($value->methode_paie == "espece") {
                $espece += $value->total_a_payer;
            } elseif ($value->methode_paie == "carte-bancaire") {
                $carte += $value->total_a_payer;
            } elseif ($value->methode_paie == "offert") {
                $offert += $value->total_a_payer;
            } elseif ($value->methode_paie == "en-compte") {
                $compte += $value->total_a_payer;
            }
        }

        $cloturage =  new Cloturage;
        $cloturage->id_trav = Auth::user()->id;
        $cloturage->nombreOperation = $operation;
        $cloturage->montant = $montant;
        $cloturage->montant_espece = $espece;
        $cloturage->montant_compte = $compte;
        $cloturage->montant_offert = $offert;
        $cloturage->montant_carte = $carte;
        $cloturage->save();

        $montant = 0;
        foreach ($operations as $key => $value) {
            $montant = $montant + ($value->total_a_payer - $value->total_a_payer * $value->remise / 100);
            $detailOperation = Operation::where('id', $value->id_operation)->first();
            $detailOperation->cloturage = $cloturage->id;
            $detailOperation->update();
        }

        $cloturageU = Cloturage::where('id', $cloturage->id)->first();

        $cloturageU->montant = $montant;
        $cloturageU->update();



        $client = new GuzzleHttp\Client();


        $config = Config::latest()->first();

        $api_url = $config->url_parent;
        $id_pv = $config->guid_depot;



        $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
            'form_params' => [
                'act' => "insert_cloturage",
                'client' => $id_pv,
                'pwd'=>"8US64H%kMla6AqCVO9GkJZ%@5vb9",
                'data' => [
                    "id_clotur_pv"=>$cloturageU->id,
                    "id_trav"=>$cloturageU->id_trav,
                    "montant"=>$cloturageU->montant,
                    "nombreOperation"=>$cloturageU->nombreOperation,
                    "created_at"=>$cloturageU->created_at,
                    "updated_at"=>$cloturageU->updated_at,
                    "montant_espece"=>$cloturageU->montant_espece,
                    "montant_carte"=>$cloturageU->montant_carte,
                    "montant_compte"=>$cloturageU->montant_compte,
                    "montant_offert"=>$cloturageU->montant_offert
                ]
            ]

        ]);


        $body = $response->getBody()->getContents();





        return $montant;
    }

    public function cloturageOperation(Request $data)
    {

        $cloturages = Cloturage::where('cloturages.id_trav', $data->id)
            ->whereDate('cloturages.created_at', '>=', $data->dateD)
            ->whereDate('cloturages.created_at', '<=', $data->dateF)

            ->join('travailleurs', 'travailleurs.id', 'cloturages.id_trav')
            ->select('travailleurs.*', 'cloturages.*', 'cloturages.id as idC')
            ->where('statut', '1')
            ->get();

        return response()->json(['cloturages' => $cloturages]);
    }

    public function prodCloturage(Request $data)
    {

        $cloturages = Operation::where('operations.cloturage', $data->id)
            ->join('detail_operations', 'detail_operations.id_operation', 'operations.id')
            ->join('prods', 'prods.id', 'detail_operations.id_prod')
            ->select('operations.*', 'detail_operations.*', 'prods.*', 'detail_operations.prix as prixTicket')
            ->where('statut', '1')
            ->get();

        return response()->json(['cloturages' => $cloturages]);
    }


    public function consulte()
    {

        $operations = Operation::where('id_trav', Auth::user()->id)
            ->where('statut', '1')
            ->whereDate('created_at', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['operations' => $operations]);
    }

    public function tableOperationConsult(Request $data)
    {

        $prods = DetailOperation::where('detail_operations.id_operation', $data->id)
            ->join('prods', 'prods.id', 'detail_operations.id_prod')
            ->select('detail_operations.*', 'prods.*', 'detail_operations.prix as prixTicket')
            ->get();

        return response()->json(['prods' => $prods]);
    }

    public function ListCloturage(Request $data)
    {

        $cloturages = Cloturage::where('cloturages.id_trav', $data->id_trav)
            ->whereDate('cloturages.created_at', '>=', $data->dateD)
            ->whereDate('cloturages.created_at', '<=', $data->dateF)
            ->join('travailleurs', 'travailleurs.id', 'cloturages.id_trav')
            ->select('travailleurs.*', 'cloturages.*', 'cloturages.id as idC')
            ->get();



        return view("Admin.recette.Imprimer_Cloturage")->with('cloturages', $cloturages);
    }

    public function exportExcel(Request $data)
    {

        $cloturages = Cloturage::where('cloturages.id_trav', $data->id_trav)
            ->whereDate('cloturages.created_at', '>=', $data->dateD)
            ->whereDate('cloturages.created_at', '<=', $data->dateF)
            ->join('travailleurs', 'travailleurs.id', 'cloturages.id_trav')
            ->select('travailleurs.*', 'cloturages.*', 'cloturages.id as idC')
            ->get();


        return view("Admin.recette.excel")->with('cloturages', $cloturages);
    }
}
