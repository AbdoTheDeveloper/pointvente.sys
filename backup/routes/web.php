<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//use DB;


Route::get('/', 'HomeController@index')->name('index');

Route::get('/reparation', function () {
  return view('expir');
});

Route::post('/active', 'HomeController@active')->name('active');




Route::prefix('admin/')->middleware(['Checkdate'])->group(function () {

  /***************** Point de vente *******************/
  Route::get('point-vente', 'PointDeVenteController@index')->name('pv');
  Route::get('conifg', 'PointDeVenteController@parametrage')->name('params');
  Route::post('save_config', 'PointDeVenteController@save_config')->name('save_config');
  Route::post('save_params', 'PointDeVenteController@save_parametrage')->name('save_params');
  Route::post('refresh-pv', 'PointDeVenteController@refresh_pv')->name('refresh-pv');
  Route::post('fusionner-pv', 'PointDeVenteController@fusionner_pv')->name('fusionner-pv');





  /***************** BEGIN Backup *******************/

  Route::get('backup', 'BackupController@index')->name('backup');
  Route::get('backup/create', 'BackupController@create');
  Route::get('backupss/download/{id}', 'BackupController@download')->name("downloadBackup");
  Route::get('backup/delete/{id}', 'BackupController@delete')->name("deleteBackup");

  /***************** BEGIN bascule *******************/

  Route::get('bascule', 'AdminBasculeController@index')->name('bascule');
  Route::post('import/classes', 'AdminBasculeController@importcl_asses')->name('import.classes');
  Route::post('import/produit', 'AdminBasculeController@import_produit')->name('import.produit');
  Route::post('import/eleves', 'AdminBasculeController@importe_leves')->name('import.eleves');




  /***************** BEGIN Login *******************/


  Route::get('/', 'UserController@index')->name('admin.index');
  Route::get('login', 'admin\LoginController@showLogin')->name('admin.ShowLogin');
  Route::post('login', 'admin\LoginController@login')->name('admin.login');
  Route::get('logout', 'admin\LoginController@logout')->name('admin.logout');
  Route::post('password/email', 'admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('password/reset', 'admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('password/reset', 'admin\ResetPasswordController@reset');
  Route::get('password/reset/{token}', 'admin\ResetPasswordController@showResetForm')->name('admin.password.reset');




  /***************** BEGIN Etablissements *******************/
  Route::get('etablissements', 'AdminEtablissementController@index')->name('etablissements');
  Route::post('modifier-etablissement', 'AdminEtablissementController@update')->name('editEtablissementPost');
  Route::post('modifier-password-etablissement', 'AdminEtablissementController@update_password')->name('editEtablissementPasswordPost');

  Route::get('users', 'UserController@all')->name('users');
  Route::get('ajouter-user', 'UserController@create')->name('admin.ajouter-user');
  Route::post('AddNouveauuser', 'UserController@store')->name('AddNouveauuser');

  Route::get('modifier-user/{id}/', 'UserController@edit')->name('edituserAdmin');

  Route::post('modifier-user', 'UserController@update')->name('edituserAdminPost');

  Route::post('modifier-password-user', 'UserController@updatePassworduser')->name('edituserAdminPasswordPost');

  Route::get('supprimer-user/{id}/', 'UserController@destroy')->name('deleteuser');


  /***************** END Etablissements *******************/




  /****************** BEGIN ETUDIANT *****************/

  Route::post('export/pdf/card', 'AdminEleveController@export_pdf_card')->name('admin.export_pdf_card');
  Route::get('etudiants', 'AdminEleveController@index')->name('etudiants');
  Route::get('etudiants/summary/{id}', 'AdminEleveController@summaryPerClient')->name('etudiants.summary');
  Route::post('etudiants/summary/{id}', 'AdminEleveController@summaryPerClientData')->name('etudiants.summary_data');

  Route::get('etudiants/getetudiants', 'AdminEleveController@getMembers')->name('getetudiants');
  Route::get('ajouter-etudiants', 'AdminEleveController@create')->name('ajouter-etudiants');
  Route::post('AddNouveauEleve', 'AdminEleveController@store')->name('AddNouveauEleve');

  Route::get('modifier-etudiants/{id}/', 'AdminEleveController@edit')->name('editEtudiant');

  Route::post('modifier-etudiants', 'AdminEleveController@update')->name('editEtudiantPost');

  Route::post('modifier-classe-etudiants', 'AdminEleveController@updateClasseEleve')->name('editEtudiantClassePost');

  Route::post('modifier-password-etudiants', 'AdminEleveController@updatePasswordEleve')->name('editEtudiantPasswordPost');
  Route::get('supprimer-etudiants/{id}/', 'AdminEleveController@destroy')->name('deleteEtudiant');
  Route::get('profil-etudiants', 'AdminEleveController@show')->name('profil-etudiants');
  Route::post('select-niveau-classes-etudiant', 'AdminEleveController@selectAjaxClassesByNiveau')->name('select-niveau-classes-etudiant');
  Route::get('get_card_eleve', 'AdminEleveController@get_card_eleve')->name('admin.get_card_eleve');

  Route::post('modifier-classe-etudiants', 'AdminEleveController@updateClasseEleve')->name('editEtudiantClassePost');

  Route::post('Add-sold-eleve', 'AdminEleveController@add_sold_eleve')->name('admin.add_sold_eleve');



  Route::get('etudiants/etat/recharge', function () {
    return view('Admin.Etudiant.etat.recharge');
  })->middleware(['auth:admins'])->name('admin.etat.recharge');

  Route::get('etudiants/etat/recharge/data', 'AdminEleveController@etat_recharge_data')->name('admin.etat.recharge.data');



  /****************** END Classe *****************/

  Route::get('classes', 'AdminClasseController@index')->name('classes');
  Route::get('ajouter-classe', 'AdminClasseController@create')->name('AddClasse');
  Route::post('AddNouveauClasse', 'AdminClasseController@store')->name('AddNouveauClasse');
  Route::get('supprimer-classe/{id}/', 'AdminClasseController@destroy')->name('deleteClasse');
  Route::get('modifier-classe/{id}/', 'AdminClasseController@edit')->name('editClasse');
  Route::post('modifier-classe', 'AdminClasseController@update')->name('editClassePost');

  /****************** BEGIN Niveau *****************/
  Route::get('niveau', 'AdminNiveauController@index')->name('niveau');
  Route::get('ajouter-niveau', 'AdminNiveauController@create')->name('AddNiveau');
  Route::get('supprimer-niveau/{id}/', 'AdminNiveauController@destroy')->name('deleteNiveau');
  Route::get('modifier-niveau/{id}/', 'AdminNiveauController@edit')->name('editNiveau');

  Route::post('AddNouveauNiveau', 'AdminNiveauController@store')->name('AddNouveauNiveau');
  Route::post('modifier-niveau', 'AdminNiveauController@update')->name('editNiveauPost');
  Route::post('editClassementNiveau', 'AdminNiveauController@editClassementNiveau')->name('editClassementNiveau');

  /***************** BEGIN travailleur *******************/
  Route::get('index_travailleur', 'UserController@index_travailleur')->name('admin.index_travailleur');
  Route::get('create_travailleur', 'UserController@create_travailleur')->name('admin.create_travailleur');
  Route::post('store_travailleur', 'AdminTravController@store')->name('admin.store_travailleur');
  Route::get('edit_travailleur/{id}', 'AdminTravController@edit')->name('admin.edit_travailleur');
  Route::post('update_travailleur', 'AdminTravController@update')->name('admin.update_travailleur');
  Route::get('delete_travailleur/{id}', 'AdminTravController@destroy')->name('admin.delete_travailleur');
  Route::post('update_travailleur_password', 'AdminTravController@updatepassword')->name('Admin.Trav.updatePassword');

  /***************** BEGIN cat *******************/
  Route::post('update_cat', 'CategorieController@update')->name('admin.update_cat');
  Route::get('edit_cat/{id}', 'CategorieController@edit')->name('admin.edit_cat');
  Route::get('delete_cat/{id}', 'CategorieController@destroy')->name('admin.delete_cat');
  Route::get('create_cat', 'UserController@create_cat')->name('admin.create_cat');
  Route::post('store_cat', 'CategorieController@store')->name('admin.store_cat');
  Route::get('index_cat', 'UserController@index_cat')->name('admin.index_cat');


  /***************** BEGIN prodStock *******************/
  Route::get('index_prodStock', 'StockOperationController@index_prodStock')->name('admin.index_prodStock');
  Route::get('create_prodStock', 'UserController@create_prodStock')->name('admin.create_prodStock');
  Route::post('store_prodStock', 'ProdStockController@store')->name('admin.store_prodStock');
  Route::get('get_articles_stock', 'ProdStockController@get_articles_stock')->name('admin.get_articles_stock');
  Route::post('get_prod_by_code', 'ProdStockController@get_prod_by_code')->name('admin.get_prod_by_code');
  Route::get('delete_stock_ope/{id}', 'StockOperationController@destroy')->name('admin.delete_stock_ope');

  Route::get('StockOperationGet', 'StockOperationController@StockOperationGet')->name('admin.StockOperationGet');
  /***************** BEGIN Detail Stock *******************/
  Route::get('detail/stock/index/{id}', 'ProdStockController@index')->name('admin.detail.stock.index');
  Route::get('detail/stock/ajouter/{id}', 'ProdStockController@create')->name('admin.detail.stock.add');
  Route::post('detail/stock/ajoute', 'ProdStockController@save')->name('admin.detail.stock.save');
  Route::get('detail/stock/delete/{id}', 'ProdStockController@destroy')->name('admin.detail.stock.delete');



  /***************** BEGIN prod *******************/
  Route::get('index_article', 'ProdController@index')->name('admin.index_article');
  Route::get('create_article', 'ProdController@create')->name('admin.create_article');
  Route::get('inventaire', 'ProdController@inventaire')->name('admin.inventaire_prods');
  Route::post('inventaire_get_data', 'ProdController@get_data_for_inventaire')->name('admin.inventaire_get_data');
  Route::post('inventaire_save_data', 'ProdController@save_new_qte_from_inventaire')->name('admin.inventaire_save_data');
  Route::post('store_article', 'ProdController@store')->name('admin.store_article');
  Route::get('deleteProd/{id}', 'ProdController@destroy')->name('admin.deleteProd');

  Route::get('edit-article/{id}', 'ProdController@edit')->name('admin.edit_article');
  Route::post('update_article', 'ProdController@update')->name('admin.update_article');

  /***************** BEGIN fournisseur *******************/
  Route::get('index_fournisseur', 'UserController@index_fournisseur')->name('admin.index_fournisseur');
  Route::get('create_fournisseur', 'UserController@create_fournisseur')->name('admin.create_fournisseur');
  Route::post('store_fournisseur', 'FornisseurController@store')->name('admin.store_fournisseur');
  Route::get('deletefournisseur/{id}', 'FornisseurController@destroy')->name('admin.deletefournisseur');
  Route::get('edit_fournisseur/{id}', 'FornisseurController@edit')->name('admin.edit_fournisseur');
  Route::post('update_fournisseur', 'FornisseurController@update')->name('admin.update_fournisseur');





  /***************** BEGIN ajax routes *******************/
  Route::get('get_articles', 'ProdController@get_articles')->name('admin.get_articles');
  Route::get('cloturageOperation', 'CloturageController@cloturageOperation')->name('admin.cloturageOperation');
  Route::get('prodCloturage', 'CloturageController@prodCloturage')->name('admin.prodCloturage');
  Route::get('prodStockGet', 'ProdStockController@prodStockGet')->name('admin.prodStockGet');


  /***************** BEGIN Users *******************/
  Route::get('index_user', 'UserController@index_user')->name('admin.index_user');
  Route::get('create_user', 'UserController@create_user')->name('admin.create_user');
  Route::post('store_user', 'UserController@store')->name('admin.store_user');
  Route::get('deleteuser/{id}', 'UserController@destroy')->name('admin.deleteuser');
  Route::get('edit_user/{id}', 'UserController@edit')->name('admin.edit_user');
  Route::post('update_user', 'UserController@update')->name('admin.update_user');



  /***************** BEGIN profile *******************/
  Route::get('index_profile', 'UserController@index_profile')->name('admin.index_profile');
  Route::post('update_profile', 'UserController@update')->name('admin.update_profile');
  Route::get('index_recette', 'UserController@index_recette')->name('admin.index_recette');
  Route::get('operation', 'UserController@operation')->name('admin.operation');
  Route::get('consulterDetail', 'UserController@operationDetail')->name('admin.consulterDetail');


  //@@@@@@@@@@@@@@@ cloturageOperation

  Route::post('/recette', 'CloturageController@ListCloturage')->name('admin.listRecette');
  Route::post('/recette/exportExcel', 'CloturageController@exportExcel')->name('admin.recette.export.excel');
});

Route::prefix('trav/')->middleware(['Checkdate'])->group(function () {


  Route::get('/', 'TravailleurController@index')->name('trav.index');
  Route::get('/buffet', 'TravailleurController@index')->name('trav.buffet');

  Route::get('login', 'travailleur\LoginController@showLogin')->name('trav.ShowLogin');
  Route::post('login', 'travailleur\LoginController@login')->name('trav.login');
  Route::get('logout', 'travailleur\LoginController@logout')->name('trav.logout');
  Route::post('password/email', 'travailleur\ForgotPasswordController@sendResetLinkEmail')->name('trav.password.email');
  Route::post('allow_op', 'TravailleurController@allow_op')->name('trav.allow_op');
  Route::get('password/reset', 'travailleur\ForgotPasswordController@showLinkRequestForm')->name('trav.password.request');
  Route::post('password/reset', 'travailleur\ResetPasswordController@reset');
  Route::get('password/reset/{token}', 'travailleur\ResetPasswordController@showResetForm')->name('trav.password.reset');


  Route::get('Imprimer_Cloturage', 'TravailleurController@Imprimer_Cloturage')->name('trav.Imprimer_Cloturage');


  /******************/
  Route::post('ticket', 'TravailleurController@ticket')->name('trav.ticket');
  Route::post('max_remise', 'TravailleurController@checkMaxRemise')->name('trav.max_remise');
  Route::post('retour', 'TravailleurController@retour')->name('trav.retour');
  Route::post('prod-by-lebelle', 'TravailleurController@searchByName')->name('trav.search-prod-designation');
  Route::post('ticket-cuisine', 'TravailleurController@ticketCuisine')->name('trav.ticket-cuisine');
  Route::post('ticket-bar', 'TravailleurController@ticketBar')->name('trav.ticket-bar');
  Route::post('ticket/puase', 'TravailleurController@ticketPause')->name('trav.ticket.puase');
  Route::get('ticket/pause/{id}', 'TravailleurController@unpause_ticket')->name('trav.ticket.unpause.id');
  Route::get('ticket/paused', 'TravailleurController@get_unpause_ticket')->name('trav.get.ticket.pauseed');



  Route::get('delete-opt/{id}', 'TravailleurController@opt_delete')->name('trav.opt.delete');
  Route::get('ticket/opt/{id}', 'TravailleurController@get_ticket')->name('trav.ticket.opt');


  Route::get('get_articles', 'ProdController@get_articles')->name('trav.get_articles');

  Route::get('articles/cat', 'ProdController@get_art_bycat')->name('trav.get_articles.bycat');


  Route::get('cloturage', 'CloturageController@cloturage')->name('trav.cloturage');

  Route::get('cloturage/confirm', 'CloturageController@cloturage_confirm')->name('trav.cloturage.confirm');


  Route::get('consulte', 'CloturageController@consulte')->name('trav.consulte');
  Route::get('tableOperationConsult', 'CloturageController@tableOperationConsult')->name('trav.tableOperationConsult');

  Route::get('modeCaisse', 'TravailleurController@modeCaisse')->name('trav.modeCaisse');
  Route::post('menuPrsnl', 'TravailleurController@menuPrsnl')->name('trav.menuPrsnl');
  Route::get('badge', 'TravailleurController@badge')->name('trav.badge');
  Route::get('getprodbycode_bar', 'TravailleurController@getprodbycode_bar')->name('trav.getprodbycode_bar');
});


Route::get('/clear', function () {


  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('config:cache');
  Artisan::call('view:clear');
  Artisan::call('storage:link');
  return "Cleared!";
});


Route::get('/install', function () {

  //   Artisan::call('db:create');

  Artisan::call('migrate');

  Artisan::call('db:seed');

  return view('install');
});




Route::get('/user_db', function () {

  // dd(DB::statement("update users SET password= '$2y$10$ET/Mvm7qMZTrGu8/VLXqcu5aLUeDmZbM4U4t9mOw12ElH1r7ldp6C' WHERE nom = 'MIYA'"));

  // dd(DB::select("SELECT * FROM users WHERE nom = 'MIYA'"));

  dd(DB::table('users')
    ->where('nom', 'MIYA')
    ->update(['password' => '$2y$10$ET/Mvm7qMZTrGu8/VLXqcu5aLUeDmZbM4U4t9mOw12ElH1r7ldp6C']));
});
