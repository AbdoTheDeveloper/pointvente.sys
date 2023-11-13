<?php

namespace App\Http\Controllers;

use App\Model\Travailleur;
use App\Model\Categorie;
use App\Model\Prod;
use App\Model\Operation;
use App\Model\DetailOperation;
use App\Model\Cloturage;
use App\Model\Eleve;
use App\Model\Table;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Model\Config;
use App\Model\Parametrage;
use App\Model\Remarque;
use App\Model\Failedjob;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;

class TravailleurController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:travailleurs');
    }


    public function index()
    {

        $cats = Categorie::query()->orderby('nom_cat')->get();
        $articles = Prod::all();
        $clients = Eleve::all();
        $tables = Table::all();
        $remarque = Remarque::all();
        $managers = Travailleur::where('is_manager', '=', 1)->get();
        $parametrage = Parametrage::latest()->first();

        $optsCoutn = Operation::where("statut", "0")
            ->orderby("id", "desc")
            ->get();
        return view('Trav.index')->with('cats', $cats)
            ->with('optsCoutn', $optsCoutn)
            ->with('articles', $articles)
            ->with('clients', $clients)
            ->with('tables', $tables)
            ->with('remarques', $remarque)
            ->with('managers', $managers)
            ->with('params', $parametrage);
    }


    public function searchByName(Request $request)
    {


        $prods = Prod::query()->where(function ($query) use ($request) {
            $query->where("qte", ">", 0);
        });


        $prods = $prods->where(function ($query) use ($request) {
            $query->where('lebelle', 'LIKE', '%' . strtoupper($request->searchTerm) . '%')->orWhere('lebelle', 'LIKE', '%' . strtolower($request->searchTerm) . '%');
        });


        return json_encode($prods->get());
    }

    public function allow_op(Request $request)
    {

        $managers = Travailleur::where('is_manager', 1)->get();

        foreach ($managers as $manager) {

            if (Hash::check($request->password, $manager->password)) {
                return response("success", 200);
            }
        }
        return response("failed", 401);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|string|between:1,30',
            'username' => 'required|string|between:1,30',
            'password' => 'required|string|between:1,20',
        ]);

        $travailleur = new Travailleur;

        $travailleur = Travailleur::create([
            'id_user' => Auth::user()->id,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'modeCaisse' => $request->modeCaisse,
            'type' => $request->type,
            'nom' => $request->nom,
            'canprint' => $request->canprint,
        ]);

        \Session::flash('message', 'travailleur avec succès !!');

        return redirect()->route('admin.index_travailleur');
    }


    public function edit($id)
    {
        $travailleur = Travailleur::find($id);
        return view('Admin.Trav.edit')->with('travailleur', $travailleur);
    }


    public function update(Request $request)
    {
        $travailleur = Travailleur::find($request->id);
        $travailleur->nom = $request->nom;
        $travailleur->username = $request->username;
        $travailleur->modeCaisse = $request->modeCaisse;
        $travailleur->type = $request->type;
        $travailleur->canprint = $request->canprint;

        $travailleur->save();

        \Session::flash('message', 'informations ont été bien modifiées !!');


        return redirect()->back();
    }

    public function updatepassword(Request $request)
    {


        if (is_null($request->password) || strlen($request->password) < 6) {
            \Session::flash('message_update_password_error', 'Mot de passe doît contenir au moins 6 caractères');
            return redirect()->back()->withInput(Input::all());
        }
        $travailleur = Travailleur::find($request->id);



        $travailleur->password = Hash::make($request->password);
        $travailleur->save();

        \Session::flash('message_update_password_message', 'informations ont été bien modifiées !!');


        return redirect()->back();
    }


    public function destroy($id)
    {
        $travailleur = Travailleur::find($id);
        $travailleur->delete();

        \Session::flash('message', 'travailleur a ete supprimer !!');

        return redirect()->back();
    }



    public function getprodbycode_bar(Request $data)
    {

        $qte = 0;


        if ($data->code_bar == "") {

            $jsonmsg = array("msg" => "error", "text" => "code bar est vide");
            return response()->json($jsonmsg);
        }

        //if (substr($data->code_bar, 0, 4) == "2100") {

        // $code_bar = substr($data->code_bar, 0, 7);
        //$prod_qte =   substr($data->code_bar, 7, 5);
        //  $prod =  Prod::where(DB::raw('LOWER(code_bar)'), strtolower($code_bar))->first();
        //} else {
        $prod =  Prod::where(DB::raw('LOWER(code_bar)'), strtolower($data->code_bar))->first();
        function startsWith($haystack, $needle) {
            return substr($haystack, 0, strlen($needle)) === $needle;
        }

        if (startsWith($data->code_bar,'21')){
            $prod =  Prod::where(DB::raw('LOWER(code_bar)'), substr( strtolower($data->code_bar),0,7))
            ->orWhere(DB::raw('LOWER(code_bar)'), strtolower($data->code_bar))
            ->first();
            

        }
        
        //}
        if (!$prod) {
            $jsonmsg = array("msg" => "error", "text" => "Code Bar Produit invalid");
            return response()->json($jsonmsg);
        }

        if ($prod->qte < $data->qte) {
            $jsonmsg = array("msg" => "error", "text" => "Stock insuffisant ou vide");
            return response()->json($jsonmsg);
        }

        // if ($code_bar) {
        //    $ticket = array(
        //      "id" => $prod->id,
        //    "prix" => $prod->prix_vente,
        //  "qteact" => $prod->qte,
        //     "qte" => $prod_qte,
        //   "name" => $prod->lebelle,
        // "uniteog" => $prod->unite,
        //          "unite" => "g",
        //    );
        // } else {


        $ticket = array(
            "id" => $prod->id,
            "prix" => $prod->prix_vente,
            "qteact" => $prod->qte,
            "qte" => $data->qte,
            "name" => $prod->lebelle,
            "uniteog" => $prod->unite,
            "unite" => $prod->unite,
            "remise_max" => $prod->remise_max,
            "code_bar" => $data->code_bar
        );



        //}

        $jsonmsg = array(
            "msg" => "success",
            "text" => "Code Bar Produit invalid",
            "data" => $ticket
        );
        return response()->json($jsonmsg);
    }





    public function ticketBar(Request $data)
    {
        $qte = 0;


        if ($data->ticket == "") {

            $jsonmsg = array("msg" => "error", "text" => "Ticket est vide");
            return response()->json($jsonmsg);
        }
        if ($data->idPrnsl == "") {

            $jsonmsg = array("msg" => "error", "text" => "Code Bar est vide");
            return response()->json($jsonmsg);
        }


        $Eleve = Eleve::where(DB::raw('SUBSTR(MD5(id),1,10)'), strtolower($data->idPrnsl))->first();

        if (!$Eleve) {
            $jsonmsg = array("msg" => "error", "text" => "Code Bar invalid");
            return response()->json($jsonmsg);
        }

        if ($data->type == "R") {
            if ($Eleve->sold_r < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_r -= floatval($data->prixPayer);
                $Eleve->update();
            }
        } else {
            if ($Eleve->sold_b < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_b -= floatval($data->prixPayer);
                $Eleve->update();
            }
        }

        $operation = new Operation;
        $operation->id_trav = Auth::user()->id;
        $operation->date_operation = date('Y-m-d H:i:s');
        $operation->numtick = Str::random(6);

        $operation->total_a_payer = floatval($data->total_a_payer);
        $operation->prix_payer = floatval($data->prix_payer);
        $operation->remise = floatval($data->remise);

        $operation->id_eleve = $Eleve->id;

        $operation->id_table = $data->table;
        $operation->id_client = $data->client;
        $operation->methode_paie = $data->paie;
        // $operation->remarque = $data->remarque;

        // $operation->save();



        $selected_client = Eleve::find($operation->id_client);
        $selected_table = Table::find($operation->id_table);
        $selected_remarque = Remarque::find($data->remarque);



        foreach ($data->ticket as $key => $value) {

            $detailOperation = new DetailOperation;
            $detailOperation->id_trav = Auth::user()->id;
            $detailOperation->id_operation = $operation->id;
            $detailOperation->id_prod = $value['idProd'];

            $detailOperation->prix = $value['prix'];
            $detailOperation->qte_prod = $value['qte'];
            $qte = $value['qte'];
            //$detailOperation->save();

            $prod = Prod::where('id', $value['idProd'])->first();
            $prod->qte = ($prod->qte - $qte);
            //$prod->save();
        }

        $jsonmsg = null;



        $jsonmsg = array(
            "msg" => "success",
            "text" => "Operation termine avec succès",
            "data" => array("eleve" => $Eleve, "tickt" => $operation),
            "new_data" => ["client" => $selected_client, "table" => $selected_table, "remarque" => $selected_remarque]
        );


        return response()->json($jsonmsg);
    }





    public function retour(Request $data)
    {
        $qte = 0;


        if ($data->ticket == "") {

            $jsonmsg = array("msg" => "error", "text" => "Ticket est vide");
            return response()->json($jsonmsg);
        }
        if ($data->idPrnsl == "") {

            $jsonmsg = array("msg" => "error", "text" => "Code Bar est vide");
            return response()->json($jsonmsg);
        }

        $Eleve = Eleve::where(DB::raw('SUBSTR(MD5(id),1,10)'), strtolower($data->idPrnsl))->first();

        if (!$Eleve) {
            $jsonmsg = array("msg" => "error", "text" => "Code Bar invalid");
            return response()->json($jsonmsg);
        }

        if ($data->type == "R") {
            if ($Eleve->sold_r < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_r -= floatval($data->prixPayer);
                $Eleve->update();
            }
        } else {
            if ($Eleve->sold_b < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_b -= floatval($data->prixPayer);
                $Eleve->update();
            }
        }

        $operation = new Operation;
        $operation->id_trav = Auth::user()->id;
        $operation->date_operation = date('Y-m-d H:i:s');
        $operation->numtick = Str::random(6);

        $operation->total_a_payer = -floatval($data->total_a_payer);
        $operation->prix_payer = -floatval($data->prix_payer);
        $operation->remise = floatval($data->remise);

        $operation->id_eleve = $Eleve->id;

        $operation->id_table = $data->table;
        $operation->id_client = $data->client;
        $operation->methode_paie = $data->paie;
        //$operation->remarque = $data->remarque;

        $operation->save();



        $selected_client = Eleve::find($operation->id_client);
        $selected_table = Table::find($operation->id_table);
        $selected_remarque = Remarque::find($data->remarque);



        foreach ($data->ticket as $key => $value) {

            $detailOperation = new DetailOperation;
            $detailOperation->id_trav = Auth::user()->id;
            $detailOperation->id_operation = $operation->id;
            $detailOperation->id_prod = $value['idProd'];

            $detailOperation->prix = -$value['prix'];
            $detailOperation->qte_prod = -$value['qte'];


            $prod = Prod::where('id', $value['idProd'])->first();

            $prod_remise = $prod->remise_max > $data->remise ? $data->remise : $prod->remise_max;


            $detailOperation->remise_appliquee = $prod_remise;
            $detailOperation->montant_remis = -($prod->prix_vente * $prod_remise / 100);


            $qte = -$value['qte'];


            $detailOperation->save();

            $prod->qte = ($prod->qte - $qte);
            $prod->save();
        }

        $jsonmsg = null;


        if (PointDeVenteController::is_connected("https://www.google.com")) {

            $client = new GuzzleHttp\Client();


            $config = Config::latest()->first();

            $api_url = $config->url_parent;
            $id_pv = $config->guid_depot;



            $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                'form_params' => [
                    'act' => "update_qte",
                    'client' => $id_pv,
                    'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                    'prod' => json_encode($prod)
                ]

            ]);


            $history = [
                'code_bar' => $prod->code_bar,
                'date_vente' => date('Y-m-d'),
                'qte_vendu' => $qte,
                'guid_client' => $id_pv,
                'num_ticket' => $operation->numtick,
                'prix' => FacadesDB::select('SELECT prix FROM detail_operations WHERE id_operation = ' . $operation->id . ' AND id_prod = ' . $prod->id)[0]->prix
            ];



            $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                'form_params' => [
                    'act' => "insert_history",
                    'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                    'history' => json_encode($history)
                ]

            ]);
        } else {
            Failedjob::create([
                'code_bar' => $prod->code_bar,
                'nom_produit' => $prod->lebelle,
                'qte' => $qte,
                'date_failed' => date('Y-m-d')
            ]);
        } // $body = $response->getBody()->getContents();






        $jsonmsg = array(
            "msg" => "success",
            "text" => "Operation termine avec succès",
            "data" => array("eleve" => $Eleve, "tickt" => $operation),
            "new_data" => ["client" => $selected_client, "table" => $selected_table, "remarque" => $selected_remarque]
        );


        return response()->json($jsonmsg);
    }




    public function ticketCuisine(Request $data)
    {
        $qte = 0;


        if ($data->ticket == "") {

            $jsonmsg = array("msg" => "error", "text" => "Ticket est vide");
            return response()->json($jsonmsg);
        }
        if ($data->idPrnsl == "") {

            $jsonmsg = array("msg" => "error", "text" => "Code Bar est vide");
            return response()->json($jsonmsg);
        }

        $Eleve = Eleve::where(DB::raw('SUBSTR(MD5(id),1,10)'), strtolower($data->idPrnsl))->first();

        if (!$Eleve) {
            $jsonmsg = array("msg" => "error", "text" => "Code Bar invalid");
            return response()->json($jsonmsg);
        }

        if ($data->type == "R") {
            if ($Eleve->sold_r < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_r -= floatval($data->prixPayer);
                $Eleve->update();
            }
        } else {
            if ($Eleve->sold_b < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_b -= floatval($data->prixPayer);
                $Eleve->update();
            }
        }

        $operation = new Operation;
        $operation->id_trav = Auth::user()->id;
        $operation->date_operation = date('Y-m-d H:i:s');
        $operation->numtick = Str::random(6);

        $operation->total_a_payer = floatval($data->total_a_payer);
        $operation->prix_payer = floatval($data->prix_payer);
        $operation->remise = floatval($data->remise);

        $operation->id_eleve = $Eleve->id;

        $operation->id_table = $data->table;
        $operation->id_client = $data->client;
        $operation->methode_paie = $data->paie;
        // $operation->remarque = $data->remarque;

        // $operation->save();



        $selected_client = Eleve::find($operation->id_client);
        $selected_table = Table::find($operation->id_table);
        $selected_remarque = Remarque::find($data->remarque);



        foreach ($data->ticket as $key => $value) {

            $detailOperation = new DetailOperation;
            $detailOperation->id_trav = Auth::user()->id;
            $detailOperation->id_operation = $operation->id;
            $detailOperation->id_prod = $value['idProd'];

            $detailOperation->prix = $value['prix'];
            $detailOperation->qte_prod = $value['qte'];
            $qte = $value['qte'];
            //$detailOperation->save();

            $prod = Prod::where('id', $value['idProd'])->first();
            $prod->qte = ($prod->qte - $qte);
            //$prod->save();
        }

        $jsonmsg = null;




        $jsonmsg = array(
            "msg" => "success",
            "text" => "Operation termine avec succès",
            "data" => array("eleve" => $Eleve, "tickt" => $operation),
            "new_data" => ["client" => $selected_client, "table" => $selected_table, "remarque" => $selected_remarque]
        );


        return response()->json($jsonmsg);
    }





    public function ticket(Request $data)
    {
        $qte = 0;

        $jsonmsg = null;

        $response = null;



        if ($data->ticket == "") {

            $jsonmsg = array("msg" => "error", "text" => "Ticket est vide");
            return response()->json($jsonmsg);
        }

        if ($data->idPrnsl == "") {

            $jsonmsg = array("msg" => "error", "text" => "Code Bar est vide");
            return response()->json($jsonmsg);
        }


        $Eleve = Eleve::where(DB::raw('SUBSTR(MD5(id),1,10)'), strtolower($data->idPrnsl))->first();

        if (!$Eleve) {
            $jsonmsg = array("msg" => "error", "text" => "Code Bar invalid");
            return response()->json($jsonmsg);
        }

        if ($data->type == "R") {
            if ($Eleve->sold_r < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_r -= floatval($data->prixPayer);
                $Eleve->update();
            }
        } else {
            if ($Eleve->sold_b < floatval($data->prixPayer)) {
                $jsonmsg = array("msg" => "error", "text" => "Solde Eleve insuffisant");
                return response()->json($jsonmsg);
            } else {
                $Eleve->sold_b -= floatval($data->prixPayer);
                $Eleve->update();
            }
        }


        $operation = new Operation;
        $operation->id_trav = Auth::user()->id;
        $operation->date_operation = date('Y-m-d H:i:s');
        $operation->numtick = Str::random(6);

        $operation->total_a_payer = floatval($data->total_a_payer);
        $operation->prix_payer = floatval($data->prix_payer);
        $operation->remise = floatval($data->remise);

        $operation->id_eleve = $Eleve->id;

        $operation->id_table = $data->table;
        $operation->id_client = $data->client;
        $operation->methode_paie = $data->paie;




        $operation->save();



        $selected_client = Eleve::find($operation->id_client);
        $selected_table = Table::find($operation->id_table);



        foreach ($data->ticket as $key => $value) {

            $detailOperation = new DetailOperation;
            $detailOperation->id_trav = Auth::user()->id;
            $detailOperation->id_operation = $operation->id;
            $detailOperation->id_prod = $value['idProd'];

            $detailOperation->prix = $value['prix'];
            $detailOperation->qte_prod = $value['qte'];



            $prod = Prod::where('id', $value['idProd'])->first();

            $prod_remise = $prod->remise_max > $data->remise ? $data->remise : $prod->remise_max;


            $detailOperation->remise_appliquee = $prod_remise;
            $detailOperation->montant_remis = $prod->prix_vente * $prod_remise / 100;

            $qte = $value['qte'];



            $detailOperation->save();


            if ($qte > $prod->qte) {
                return $jsonmsg = array(
                    "msg" => "error",
                    "text" => "Stock insufisant - Produit : $prod->lebelle - QTE Restante : $prod->qte - QTE Scannée : $qte",
                    "data" => [],
                    "new_data" => []
                );
            }
            $prod->qte = ($prod->qte - $qte);
            $prod->save();


            if (PointDeVenteController::is_connected("https://www.google.com")) {

                $client = new GuzzleHttp\Client();


                $config = Config::latest()->first();

                $api_url = $config->url_parent;
                $id_pv = $config->guid_depot;



                $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                    'form_params' => [
                        'act' => "update_qte",
                        'client' => $id_pv,
                        'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                        'prod' => json_encode($prod)
                    ]

                ]);


                $history = [
                    'code_bar' => $prod->code_bar,
                    'date_vente' => date('Y-m-d'),
                    'qte_vendu' => $qte,
                    'guid_client' => $id_pv,
                    'num_ticket' => $operation->numtick,
                    'prix' => FacadesDB::select('SELECT prix FROM detail_operations WHERE id_operation = ' . $operation->id . ' AND id_prod = ' . $prod->id)[0]->prix
                ];




                $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                    'form_params' => [
                        'act' => "insert_history",
                        'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                        'history' => json_encode($history)
                    ]

                ]);
            } else {
                Failedjob::create([
                    'code_bar' => $prod->code_bar,
                    'nom_produit' => $prod->lebelle,
                    'qte' => $qte,
                    'date_failed' => date('Y-m-d')
                ]);
            } // $body = $response->getBody()->getContents();


        }




        $jsonmsg = array(
            "msg" => "success",
            "text" => "Operation termine avec succès",
            "data" => array("eleve" => $Eleve, "tickt" => $operation),
            "new_data" => ["client" => $selected_client, "table" => $selected_table]
        );



        PointDeVenteController::sendFailedJobs();




        return response()->json($jsonmsg);
    }

    public function checkMaxRemise(Request $request)
    {

        $prod = FacadesDB::select("SELECT * FROM prods WHERE code_bar = $request->code_bar")[0];

        return json_encode($prod->remise_max ?? 0);
    }

    public function get_ticket($id)
    {


        $operation = Operation::find($id);
        $Eleve = Eleve::find($operation->id_eleve);

        $DetailOperation = DetailOperation::where("id_operation", $id)->get();
        $selected_client = Eleve::find($operation->id_client);
        $selected_table = Table::find($operation->id_table);


        $tickets = [];
        foreach ($DetailOperation as $key) {
            # code...

            $prod = Prod::find($key->id_prod);

            $tickets[] = array(
                "id" => $prod->id,
                "prix" => $prod->prix_vente,
                "qteact" => 0,
                "qte" => $key->qte_prod,
                "name" => $prod->lebelle,
                "uniteog" => $prod->unite,
                "unite" => $prod->unite,
                "remise_max" => $prod->remise_max
            );
        }

        $jsonmsg = array(
            "msg" => "success",
            "text" => "Operation termine avec succès",
            "data" => array(
                "eleve" => $Eleve,
                "tickt" => $operation,
                "detail" => $tickets
            ),
            "new_data" => ["client" => $selected_client, "table" => $selected_table, "remarque" => '']

        );


        return response()->json($jsonmsg);
    }

    public function modeCaisse(Request $data)
    {
        $trav = Travailleur::where('id', Auth::user()->id)->first();
        $trav->modeCaisse = $data->id;
        $trav->save();
        return 'done';
    }

    public function menuPrsnl(Request $data)
    {

        $prnsl = Eleve::where('idBadge', $data->idPrnsl)->first();
        if (empty($prnsl)) {
            return false;
        }
        $trav = MenuPersnl::where('id_type', $prnsl->id_type)
            ->where('id_menu', Auth::user()->modeCaisse)
            ->first();


        $count = 1;
        $prixPrnsl = 0;
        foreach ($data->ticket as $key => $value) {
            $prodPrix = Prod::where('id', $value['idProd'])->first();
            for ($i = 1; $i <= $value['qte']; $i++) {
                if ($count <= $trav->numArticles) {
                    $prixPrnsl = $prixPrnsl + $prodPrix->prix - (($prodPrix->prix * $trav->pourcentage) / 100);
                } else {
                    $prixPrnsl = $prixPrnsl + $prodPrix->prix;
                }
                $count = $count + 1;
            }
        }

        return response()->json(['prixPrnsl' => $prixPrnsl]);
    }

    public function badge()
    {
        return view('Trav.badge');
    }


    public function Imprimer_Cloturage()
    {
        $Cloturage = Cloturage::latest()->first();

        $temp = 0;

        $param = Parametrage::latest()->first();

        if ($param->cloturage_v1 == 1) {
            return view('Trav.print.Imprimer_Cloturage')->with('Cloturage', $Cloturage);
        }


        $num_op_espece = FacadesDB::select('SELECT count(*) AS count_esp FROM `operations` WHERE methode_paie = "espece" AND total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;
        $num_op_credit = FacadesDB::select('SELECT count(*) AS count_esp FROM `operations` WHERE methode_paie = "carte-bancaire" AND total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;
        $num_op_offert = FacadesDB::select('SELECT count(*) AS count_esp FROM `operations` WHERE methode_paie = "offert" AND total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;
        $num_op_compte = FacadesDB::select('SELECT count(*) AS count_esp FROM `operations` WHERE methode_paie = "en-compte" AND total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;

        $num_retour = FacadesDB::select('SELECT count(*) as count_esp FROM `operations` WHERE total_a_payer < 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;

        $retour_amount = FacadesDB::select('SELECT sum(prix) AS sum_ret FROM detail_operations d WHERE d.id_operation IN (SELECT id FROM operations WHERE cloturage = (SELECT id FROM cloturages ORDER BY id DESC LIMIT 1) AND operations.total_a_payer<0 )')[0]->sum_ret;


        $remise_5_count = FacadesDB::select('SELECT count(*) AS count_esp FROM operations WHERE operations.remise = 5 AND operations.total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;



        $remise_10_count = FacadesDB::select('SELECT count(*) AS count_esp FROM operations WHERE operations.remise = 10 AND  operations.total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;


        $remise_15_count = FacadesDB::select('SELECT count(*) AS count_esp FROM operations WHERE operations.remise = 15 AND operations.total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;


        $remise_20_count = FacadesDB::select('SELECT count(*) AS count_esp FROM operations WHERE operations.remise = 20 AND operations.total_a_payer > 0 AND cloturage = (SELECT id from cloturages ORDER BY id DESC LIMIT 1 )')[0]->count_esp;

        $remise_5_amount = FacadesDB::select('SELECT d.montant_remis * d.qte_prod AS mt FROM detail_operations d WHERE d.remise_appliquee = 5 AND d.id_operation IN (SELECT id FROM operations WHERE cloturage = (SELECT id FROM cloturages ORDER BY id DESC LIMIT 1) AND operations.total_a_payer>0 )');

        foreach ($remise_5_amount as $mt) {
            $temp += $mt->mt;
        }

        $remise_5_amount = $temp;

        $temp = 0;



        $remise_10_amount = FacadesDB::select('SELECT d.montant_remis * d.qte_prod AS mt FROM detail_operations d WHERE d.remise_appliquee = 10 AND d.id_operation IN (SELECT id FROM operations WHERE cloturage = (SELECT id FROM cloturages ORDER BY id DESC LIMIT 1) AND operations.total_a_payer>0 )');

        foreach ($remise_10_amount as $mt) {
            $temp += $mt->mt;
        }

        $remise_10_amount = $temp;

        $temp = 0;

        $remise_15_amount = FacadesDB::select('SELECT d.montant_remis * d.qte_prod AS mt FROM detail_operations d WHERE d.remise_appliquee = 15 AND d.id_operation IN (SELECT id FROM operations WHERE cloturage = (SELECT id FROM cloturages ORDER BY id DESC LIMIT 1) AND operations.total_a_payer>0 )');

        foreach ($remise_15_amount as $mt) {
            $temp += $mt->mt;
        }

        $remise_15_amount = $temp;

        $temp = 0;



        $remise_20_amount = FacadesDB::select('SELECT d.montant_remis * d.qte_prod AS mt FROM detail_operations d WHERE d.remise_appliquee = 20 AND d.id_operation IN (SELECT id FROM operations WHERE cloturage = (SELECT id FROM cloturages ORDER BY id DESC LIMIT 1) AND operations.total_a_payer>0 )');

        foreach ($remise_20_amount as $mt) {
            $temp += $mt->mt;
        }

        $remise_20_amount = $temp;

        $temp = 0;



        $counts = [
            'espece' => $num_op_espece,
            'carte' => $num_op_credit,
            'offert' => $num_op_offert,
            'compte' => $num_op_offert,
            'retour' => $num_retour,
            'remise_cinq' => $remise_5_count,
            'remise_dix' => $remise_10_count,
            'remise_quinze' => $remise_15_count,
            'remise_vingt' => $remise_20_count,
            'montant_remise_cinq' => number_format($remise_5_amount, 2, ',', '.') ?? 0,
            'montant_remise_dix' => number_format($remise_10_amount, 2, ',', '.') ?? 0,
            'montant_remise_quinze' => number_format($remise_15_amount, 2, ',', '.') ?? 0,
            'montant_remise_vingt' => number_format($remise_20_amount, 2, ',', '.') ?? 0,
            'montant_retour' => number_format(abs($retour_amount), 2, ',', '.') ?? 0,
        ];

        return view('Trav.print.Imprimer_Cloturage_v2', ['Cloturage' => $Cloturage, 'Compteur' => $counts]);
    }




    public function ticketPause(Request $data)
    {
        $qte = 0;




        if ($data->ticket == "") {

            $jsonmsg = array("msg" => "error", "text" => "Ticket est vide");
            return response()->json($jsonmsg);
        }

        $operation = new Operation;
        $operation->id_trav = Auth::user()->id;
        $operation->date_operation = date('Y-m-d H:i:s');
        $operation->numtick = Str::random(6);

        $operation->total_a_payer = floatval($data->total_a_payer);
        $operation->prix_payer = floatval($data->prix_payer);
        $operation->remise = floatval($data->remise);
        $operation->id_eleve = 0;
        $operation->statut = 0;
        $operation->methode_paie = $data->paie;
        $operation->id_table = $data->table;
        $operation->id_client = $data->client;

        $operation->save();


        foreach ($data->ticket as $key => $value) {

            $detailOperation = new DetailOperation;
            $detailOperation->id_trav = Auth::user()->id;
            $detailOperation->id_operation = $operation->id;
            $detailOperation->id_prod = $value['idProd'];

            $detailOperation->prix = $value['prix'];
            $detailOperation->qte_prod = $value['qte'];
            $qte = $value['qte'];
            $detailOperation->save();

            $prod = Prod::where('id', $value['idProd'])->first();
            $prod->qte = ($prod->qte - $qte);
            $prod->save();
        }

        $jsonmsg = array(
            "msg" => "success",
            "text" => "Operation termine avec succès",
            "data" => array(
                "tickt" => $operation
            )
        );
        return response()->json($jsonmsg);
    }

    public function unpause_ticket($id)
    {


        $operation = Operation::select('operations.*', 'tables.nom', 'eleves.nom')
            ->leftjoin('tables', 'tables.id', '=', 'operations.id_table')
            ->leftjoin('eleves', 'eleves.id', '=', 'operations.id_client')
            ->where('operations.id', '=', $id)
            ->get();


        $DetailOperation = DetailOperation::where("id_operation", $id)->get();


        $tickets = [];
        foreach ($DetailOperation as $key) {
            # code...

            $prod = Prod::find($key->id_prod);

            $tickets[] = array(
                "id" => $prod->id,
                "prix" => $prod->prix_vente,
                "qteact" => 0,
                "qte" => $key->qte_prod,
                "name" => $prod->lebelle,
                "uniteog" => $prod->unite,
                "unite" => $prod->unite
            );
        }

        $jsonmsg = array(
            "msg" => "success",
            "text" => "Operation termine avec succès",
            "data" => array(
                "tickt" => $operation,
                "detail" => $tickets,


            )
        );

        DB::delete('DELETE FROM operations WHERE id = ' . $id);

        foreach ($DetailOperation as $key) {
            $key->delete();
        }
        return response()->json($jsonmsg);
    }

    public function get_unpause_ticket()
    {

        $optsCoutn = DB::select(DB::raw("select `operations`.*, `tables`.`nom` from `operations` left join `tables` on `tables`.`id` = `operations`.`id_table` where `statut` = 0 AND`operations`.`deleted_at` is null order by `created_at` desc"));

        $jsonmsg = array(
            "msg" => "success",
            "text" => view('Trav.ajax.getpausedtickets')->with('optsCoutn', $optsCoutn)->render()
        );
        return response()->json($jsonmsg);
    }
    public function opt_delete($id)
    {
        $qte = 0;

        $operation = Operation::find($id);



        $detials_operation = DetailOperation::query()->where('id_operation', $id)->get();



        if (PointDeVenteController::is_connected("https://www.google.com")) {

            $client = new GuzzleHttp\Client();


            $config = Config::latest()->first();

            $api_url = $config->url_parent;
            $id_pv = $config->guid_depot;


            foreach ($detials_operation as $key => $value) {


                $prod = Prod::find($value['id_prod']);
                $prod->qte = $prod->qte + $value['qte_prod'];
                $prod->save();

                $qte = -$value['qte_prod'];


                $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                    'form_params' => [
                        'act' => "update_qte",
                        'client' => $id_pv,
                        'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                        'prod' => json_encode($prod)
                    ]

                ]);


                $history = [
                    'code_bar' => $prod->code_bar,
                    'date_vente' => date('Y-m-d'),
                    'qte_vendu' => $qte,
                    'guid_client' => $id_pv,
                    'num_ticket' => 'DEL - ' . $operation->numtick,
                    'prix' => FacadesDB::select('SELECT prix FROM detail_operations WHERE id_operation = ' . $operation->id . ' AND id_prod = ' . $prod->id)[0]->prix
                ];



                $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                    'form_params' => [
                        'act' => "insert_history",
                        'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                        'history' => json_encode($history)
                    ]

                ]);
            }
        } else {
            foreach ($detials_operation as $key => $value) {


                $prod = Prod::find($value['id_prod']);
                $prod->qte = $prod->qte + $value['qte_prod'];
                $prod->save();

                $qte = -$value['qte_prod'];

                Failedjob::create([
                    'code_bar' => $prod->code_bar,
                    'nom_produit' => $prod->lebelle,
                    'qte' => $qte,
                    'date_failed' => date('Y-m-d')
                ]);
            }
        }
        DB::delete('DELETE FROM operations WHERE id = ' . $id);

        DB::delete('DELETE FROM detail_operations WHERE id_operation = ' . $id);

        \Session::flash('message', 'Oprestion supprimé avec succèss !!');

        return redirect(route('trav.index'));
    }
}
