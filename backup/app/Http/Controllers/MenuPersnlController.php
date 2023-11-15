<?php

namespace App\Http\Controllers;

use App\Model\MenuPersnl;
use App\Model\TypePersnl;
use App\Model\Menu;
use Illuminate\Http\Request;

use Auth;

class MenuPersnlController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $this->validate($request, [
        'type' => 'required',
        'menu' => 'required',
        'numArticles' => 'required|numeric',
        'pourcentage' => 'required|numeric',
          ]);

        $menu = new MenuPersnl;
        $menu->id_user = Auth::user()->id;
        $menu->id_type = $request->type;
        $menu->id_menu = $request->menu;
        $menu->numArticles = $request->numArticles;
        $menu->pourcentage = $request->pourcentage;
        $menu->save();


        \Session::flash('success', 'operation avec succès !!'); 

        return redirect()->back();
    }


    public function show(MenuPersnl $menuPersnl)
    {
        //
    }


    public function edit($id)
    {
        $menuPersnl = MenuPersnl::find($id);
        $menus = Menu::all();
        $types = TypePersnl::all();
        return view('admin.menu.editMenuPersnl')->with('menuPersnl',$menuPersnl)->with('menus',$menus)->with('types',$types);
    }


    public function update(Request $request)
    {
        $menu = MenuPersnl::where('id',$request->id)->first();
        $menu->id_user = Auth::user()->id;
        $menu->id_type = $request->type;
        $menu->id_menu = $request->menu;
        $menu->numArticles = $request->numArticles;
        $menu->pourcentage = $request->pourcentage;
        $menu->save();


        \Session::flash('success', 'menu est modifie !!'); 

        return redirect()->back();
    }

    public function destroy($id)
    {
        $menuPersnl = MenuPersnl::find($id);
        $menuPersnl->delete();

        \Session::flash('success', 'menu est supprime !!'); 

        return redirect()->back();
    }
}
