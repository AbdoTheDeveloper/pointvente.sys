<?php

namespace App\Http\Controllers;

use App\Model\Categorie;
use Illuminate\Http\Request;
use App\Model\Config;
use App\Model\Failedjob;
use App\Model\Fornisseur;
use App\Model\Parametrage;
use App\Model\Prod;
use App\Model\ProdStock;
use App\Model\Stock;
use App\Model\StockOperation;
use GuzzleHttp\Client;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Support\Facades\Log;

use function App\Http\Controllers\is_connected as ControllersIs_connected;

class PointDeVenteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admins,travailleurs');
    }

    public function index()
    {
        $config = Config::latest()->first();
        if (!$config) {
            $config = new Config();
        }

        return view('Admin.pv.index', ['config' => $config]);
    }

    public function save_config(Request $request)
    {
        Config::create($request->all());

        return back();
    }


    public function parametrage()
    {

        $parametrage = Parametrage::latest()->first();


        if (!$parametrage) {
            $parametrage = new Config();
        }



        return view('Admin.params.index', ['config' => $parametrage]);
    }

    public function save_parametrage(Request $request)
    {

        $request['enable_cusisine']  = $request['enable_cusisine'] == 'on' ? 1 : 0;
        $request['enable_barman']  = $request['enable_barman'] == 'on' ? 1 : 0;


        $request['cloturage_v1']  = $request['cloturage_v1'] == 'on' ? 1 : 0;
        $request['cloturage_v2']  = $request['cloturage_v2'] == 'on' ? 1 : 0;



        $request['remarque_select']  = $request['remarque_select'] == 'on' ? 1 : 0;
        $request['table_select']  = $request['table_select'] == 'on' ? 1 : 0;
        
        
        Parametrage::create($request->all());


        return back();
    }

    public function fusionner_pv(Request $request)
    {
        $ventesToSync = json_decode($request->liste_ventes);
        $avoirToSync = json_decode($request->liste_avoir);


        $config = Config::latest()->first();
        // Create a new Guzzle client
        $client = new Client();

        $uuid = $config->guid_depot;


        $api_url = $config->url_parent;

        $client = new GuzzleHttp\Client();



        $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
            'form_params' => [
                'act' => "list_vente_details",
                'client' => $uuid,
                'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                'data' => $ventesToSync
            ]
        ]);


        $body = json_decode($response->getBody()->getContents());


        $gcmi = Fornisseur::where('nom_frns', 'gcmi')->orWhere('nom_frns', 'GCMI')->first();



        foreach ($body as $vente) {

            $stock = StockOperation::create([
                'id_user' => 1,
                'id_frns' => $gcmi->id,
                'remarque' => 'Importation Vente GCMI ' . date('Y-m-d'),
                'date_opt' => date('Y-m-d'),
            ]);


            foreach ($vente as $detail_vente) {



                $prod = Prod::where('lebelle', $detail_vente->designation)->first();

                if ($prod) {
                    $prod->update([
                        'qte' => $prod->qte + $detail_vente->qte_vendu,
                        'prix_achat' => $detail_vente->prix_achat,
                        'prix_vente' => $detail_vente->prix_vente3,
                        'remise_max' => $detail_vente->remise_max,
                        'unite' => strtoupper($detail_vente->unite) == 'U' ? 'qte' : $detail_vente->unite,

                    ]);
                } else {
                    $cat = Categorie::query()->where('nom_cat', 'LIKE', $detail_vente->nom)->first();

                    if (!$cat) {
                        $cat = Categorie::create([
                            'id_user' => 1,
                            'nom_cat' => $detail_vente->nom,
                            'type' => 'R'
                        ]);
                    }

                    $prod = Prod::create([
                        'id_user' => 1,
                        'id_cat' => $cat->id,
                        'prix_achat' => $detail_vente->prix_achat,
                        'prix_vente' => $detail_vente->prix_vente3,
                        'lebelle' => $detail_vente->designation,
                        'code_bar' => $detail_vente->code_bar,
                        'unite' => strtoupper($detail_vente->unite) == 'U' ? 'qte' : $detail_vente->unite,
                        'type' => 0,
                        'qte' => $detail_vente->qte_vendu,
                        'qte_alert' => 10,
                        'remise_max' => $detail_vente->remise_max
                    ]);
                }


                $prodStock = ProdStock::create([
                    'id_user' => 1,
                    'id_operationStock' => $stock->id,
                    'id_prod' => $prod->id,
                    'qteEntrer' => $detail_vente->qte_vendu,
                    'prixEntre' => $detail_vente->prix_vente3
                ]);
            }
        }

        //Sync Avoir code satrt


        $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
            'form_params' => [
                'act' => "list_avoir_details",
                'client' => $uuid,
                'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                'data' => $avoirToSync
            ]
        ]);


        $body = json_decode($response->getBody()->getContents());



        foreach ($body as $vente) {

            $stock = StockOperation::create([
                'id_user' => 1,
                'id_frns' => $gcmi->id,
                'remarque' => 'Importation Avoir GCMI ' . date('Y-m-d'),
                'date_opt' => date('Y-m-d'),
            ]);


            foreach ($vente as $detail_vente) {



                $prod = Prod::where('lebelle', $detail_vente->designation)->first();

                if ($prod) {
                    $prod->update([
                        'qte' => $prod->qte - $detail_vente->qte_rendu,
                    ]);
                }


                $prodStock = ProdStock::create([
                    'id_user' => 1,
                    'id_operationStock' => $stock->id,
                    'id_prod' => $prod->id,
                    'qteEntrer' => -$detail_vente->qte_rendu,
                    'prixEntre' => $detail_vente->prix_vente3
                ]);
            }
        }




        $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
            'form_params' => [
                'act' => "clear_pending",
                'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                'client' => $uuid
            ]
        ]);

        return redirect()->to('/admin/point-vente');
    }

    public function refresh_pv(Request $request)
    {


        if (PointDeVenteController::is_connected("https://www.google.com")) {

            // Create a new Guzzle client
            $client = new Client();

            $config = Config::latest()->first();
            $uuid = $config->guid_depot;


            $api_url = $config->url_parent;

            $client = new GuzzleHttp\Client();



            $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                'form_params' => [
                    'act' => "list_vente",
                    'client' => $uuid,
                    'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                    'data' => []
                ]
            ]);


            $body = $response->getBody()->getContents();


            $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                'form_params' => [
                    'act' => "list_vente_unique",
                    'client' => $uuid,
                    'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                    'data' => []
                ]
            ]);


            $unique_body = $response->getBody()->getContents();


            $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                'form_params' => [
                    'act' => "list_avoir",
                    'client' => $uuid,
                    'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                    'data' => []
                ]
            ]);


            $avoir_body = $response->getBody()->getContents();


            $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                'form_params' => [
                    'act' => "list_avoir_unique",
                    'client' => $uuid,
                    'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                    'data' => []
                ]
            ]);


            $unique_avoir_body = $response->getBody()->getContents();
        } else {
            $body = "";
        }

        return view('Admin.pv.vente-liste', ['ventes' => unserialize($body), 'unique_ventes' => unserialize($unique_body), 'avoirs' => unserialize($avoir_body), 'unique_avoir' => unserialize($unique_avoir_body)]);
    }



    public static function is_connected($url)
    {
        // Set the timeout for the request
        $timeout = 10;

        // Use get_headers() to check if the website is online
        $headers = @get_headers($url, 1);

        if ($headers && strpos($headers[0], '200') !== false) {
            // The website is online and returned a 200 OK status code
            return true;
        } else {
            // The website is offline or returned a non-200 status code
            return false;
        }
    }





    public static function sendFailedJobs()
    {
        $jobs = Failedjob::all();




        $client = new GuzzleHttp\Client();

        $config = Config::latest()->first();

        $api_url = $config->url_parent;
        $id_pv = $config->guid_depot;

        Log::info("Function started : " . $api_url . " " . $id_pv);



        if (PointDeVenteController::is_connected("https://www.google.com") && PointDeVenteController::is_connected($api_url . '/')) {

            Log::info("Connection is OK -- Starting Query");
            foreach ($jobs as $job) {

                $prod = Prod::where('code_bar', $job->code_bar)->first();
                //$prod->qte = ($prod->qte - $job->qte);
                //$prod->save();



                $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                    'form_params' => [
                        'act' => "update_qte",
                        'client-' => $id_pv,
                        'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                        'prod' => json_encode($prod)

                    ]
                ]);


                $body = $response->getBody()->getContents();
                Log::info("Job for : " . $job->nom_produit . " :");
                Log::info("Alkhadim Commercial Reply : " . $body);

                $history = [
                    'code_bar' => $prod->code_bar,
                    'date_vente' => date('Y-m-d'),
                    'qte_vendu' => $job->qte,
                    'guid_client' => $id_pv
                ];


                $response = $client->post($api_url . '/views/parametrage/pv_controller.php', [
                    'form_params' => [
                        'act' => "insert_history",
                        'pwd' => "8US64H%kMla6AqCVO9GkJZ%@5vb9",
                        'history' => json_encode($history)
                    ]

                ]);

                if ($body == "success") {
                    $job->delete();
                }
            }
        }
    }
}
