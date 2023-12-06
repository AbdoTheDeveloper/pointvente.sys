<?php

namespace App\Http\Controllers;

use App\Model\Prod;
use Illuminate\Http\Request;

use Auth;
use DB;
use Carbon\Carbon;
use App\Model\Categorie;
use App\Model\Travailleur;
use App\Model\Fornisseur;

class ProdController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admins,travailleurs');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Categorie::all();

        return view('Admin.article.index')->with('cats', $cats);
    }

    public function create()
    {
        $cats = Categorie::all();
        $travs = Travailleur::all();
        $fournisseurs = Fornisseur::all() ; 
        return view('Admin.article.add')->with('cats', $cats)->with('travs', $travs)->with('fournisseurs',$fournisseurs);
    }

    public function inventaire()
    {
        return view("Admin.article.inventaire");
    }


    public function get_data_for_inventaire(Request $request)

    {

        $methode = $request->methode;
        $valeur = $request->valeur;


        $prods = [];

        if ($methode == "nom") {
            $prods = Prod::query()->where("lebelle", "LIKE", "%" . $valeur . "%")->get();
        }

        if ($methode == "code_bar") {
            $prods = Prod::query()->where("code_bar", $valeur)->get();
        }


        return json_encode($prods);
    }
    public function save_new_qte_from_inventaire(Request $request)
    {
        $code_bar = $request->valeur;
        $new_qte = $request->nouvelle_qte;

        $prod = Prod::query()->where("code_bar", $code_bar)->update(["qte" => $new_qte]);

        return json_encode("OK");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $niceNames = array(
            'id_cat' => 'Categorie',
            'qte_alert' => 'Quantité alerte',

        );

        $this->validate($request, [
            'lebelle' => 'required|string|between:1,500',
            'id_cat' => 'required|numeric',
            'prix_achat' => 'required|numeric',
            'prix_vente' => 'required|numeric',
            'qte_alert' => 'required|numeric',

        ], [], $niceNames);

        $prod = new Prod;
        $img = null;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $img = $name;
            $file->move(public_path() . '/images/pro/', $name);
        }


        $prod->id_user = Auth::user()->id;
        $prod->id_cat = $request->id_cat;
        $prod->prix_achat = $request->prix_achat;
        $prod->prix_vente = $request->prix_vente;
        $prod->lebelle = $request->lebelle;
        $prod->code_bar = $request->code_bar;
        $prod->unite = $request->unite;
        $prod->type = $request->type;
        $prod->img = $img;
        $prod->qte = $request->qte;
        $prod->remise_max = $request->remise_max;
        $prod->id_frns =$request->id_frns ;


        $prod->save();

        \Session::flash('message', 'Article ajouté avec succès !!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prod  $prod
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        $prods = Prod::where('id_hamamt', '=', $data->id)->get();
        return response()->json(['prods' => $prods]);
    }

    public function get_art_bycat(Request $data)
    {
        $prods = Prod::where('id_cat', '=', $data->id)->where('type', '!=', 2)->where('type', '!=', 0)->where('qte', '>', 0)->get();
        return view("Trav.article.withimg")->with('prods', $prods);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prod  $prod
     * @return \Illuminate\Http\Response
     */
    public function get_articles(Request $request)
    {

        $orderby = array("lebelle", "nom_cat", "prix_achat", "prix_vente", "qte", "qte_alert");
        $draw = $request->get('draw');
        $start = $request->get('start');
        $limit = $request->get('length');
        $filter = $request->get('search');
        $order = $request->get('order');


        $search = (isset($filter['value'])) ? $filter['value'] : '';


        // get your total no of data;
        $prods =  Prod::selectRaw('prods.id,prods.type,lebelle,unite,prods.img,nom_cat,prix_achat,prix_vente,qte,qte_alert')
            ->join('categories', 'categories.id', '=', 'prods.id_cat')
            ->where('prods.id_user', Auth::id())
            ->where('lebelle', 'like', '%' . $search . '%')
            ->orWhere('nom_cat', 'like', '%' . $search . '%')
            ->orWhere('prix_achat', 'like', '%' . $search . '%')
            ->orWhere('prix_vente', 'like', '%' . $search . '%')
            ->orWhere('qte', 'like', '%' . $search . '%')
            ->orWhere('qte_alert', 'like', '%' . $search . '%')
            ->orderby($orderby[$order[0]["column"]], $order[0]["dir"])
            ->offset($start)
            ->limit($limit)->get();


        $totalprods =  Prod::selectRaw('prods.id')
            ->join('categories', 'categories.id', '=', 'prods.id_cat')
            ->where('prods.id_user', Auth::id())
            ->where('lebelle', 'like', '%' . $search . '%')
            ->orWhere('nom_cat', 'like', '%' . $search . '%')
            ->orWhere('prix_achat', 'like', '%' . $search . '%')
            ->orWhere('prix_vente', 'like', '%' . $search . '%')
            ->orWhere('qte', 'like', '%' . $search . '%')
            ->orWhere('qte_alert', 'like', '%' . $search . '%')
            ->count();
        $total_members = $totalprods;  //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $prods,
        );

        echo json_encode($data);

        return;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prod  $prod
     * @return \Illuminate\Http\Response
     */

    public function edit(Prod $Prod, $id)
    {
        $prod = Prod::find($id);
        $cats = Categorie::all();
        $travs = Travailleur::all();
        $fournisseurs = Fornisseur::all()  ;
        return view('Admin.article.edit')->with('prod', $prod)->with('cats', $cats)->with('travs', $travs)->with('fournisseurs' , $fournisseurs);
    }

    public function update(Request $request, Prod $prod)
    {
        $niceNames = array(
            'id_cat' => 'Categorie',
            'qte_alert' => 'Quantité alerte',

        );

        $this->validate($request, [
            'lebelle' => 'required|string|between:1,500',
            'id_cat' => 'required|numeric',
            'prix_achat' => 'required|numeric',
            'prix_vente' => 'required|numeric',
            'qte_alert' => 'required|numeric',

        ], [], $niceNames);

        $prod = Prod::find($request->id);
        $img = null;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $img = $name;
            $file->move(public_path() . '/images/pro/', $name);
            $prod->img = $img;
        }


        $prod->id_user = Auth::user()->id;
        $prod->id_cat = $request->id_cat;
        $prod->prix_achat = $request->prix_achat;
        $prod->prix_vente = $request->prix_vente;
        $prod->lebelle = $request->lebelle;
        $prod->type = $request->type;
        $prod->code_bar = $request->code_bar;
        $prod->unite = $request->unite;
        $prod->remise_max = $request->remise_max;
        $prod->qte = $request->qte;
        $prod->id_frns = $request->id_frns ; 



        $prod->save();

        \Session::flash('message', 'Article été bien modifiées !!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prod  $prod
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Prod::find($id);
        $prod->delete();

        \Session::flash('message', 'Produit supprimé avec succès !!');

        return redirect()->back();
    }
}
