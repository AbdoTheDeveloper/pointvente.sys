<?php

namespace App\Http\Controllers;

use App\Model\Categorie;
use App\Model\Prod;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function addProduct(Request $request)
    {

        $cat = Categorie::query()->where('nom_cat', 'LIKE', $request->categorie)->first();

        $request['id_cat'] = $cat->id;

        $prod = Prod::create($request->all());

        return ("success : " . $prod->id);
    }

    public function checkProdExists($designation)
    {
        $prod = Prod::query()->where('lebelle', 'LIKE', urldecode($designation))->first();

        if ($prod) {
            return true;
        }

        return false;
    }



    public function updateExistsingQte(Request $request){
        $prod = Prod::query()->where('lebelle', 'LIKE', $request->lebelle)->first();

        $prod->update(['qte'=>$prod->qte+$request->qte]);



    }

}



