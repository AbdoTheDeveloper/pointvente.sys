<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationException;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Model\Niveau;
use App\Model\User;
use App\Model\Classe;
use App\Model\Eleve;
use App\Model\Prod;
use App\Model\Categorie;
use App\Imports\ClasseImport;
use App\Imports\NiveauImport;
use App\Imports\EleveImport;
use App\Imports\ProdImport;
use Illuminate\Support\Facades\Hash;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;

use File;


class AdminBasculeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admins');
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
    }



    public function index()
    {
       return view("Admin.bascule.index");
    }




    public function importcl_asses(Request $request){

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $path = $request->file->getRealPath();
                $rows = Excel::toArray(new NiveauImport, $request->file('file'));
                $rows = array_filter($rows);

                for($i=1;$i<sizeof($rows[0]);$i++)
                {

                   
                    $niveau=$rows[0][$i][1];
                    $classe=$rows[0][$i][0];

                    /*if($etablissement!=null)
                    {

                        $user = User::where("nom" ,'like', '%' . $etablissement . '%' )->get()->first();
                        

                        if(Auth::id()>0 && Auth::id()==Auth::id())
                        {*/
                            $niveau_data =Niveau::where("Desc_niveau" , 'like', '%' . strtolower($niveau) . '%' )->where("id_etab" , Auth::id() )->get();
                            

                            if($niveau_data->count()<=0)
                            {
                                //INSERT NIVEAU
                                $niveau_insert_id = Niveau::create([
                                 'Desc_niveau' =>$niveau, 
                                 'id_etab' => Auth::id(), 
                                 'classement' =>0
                                ]); 

                            }
                            else
                            {
                                $niveau_insert_id=$niveau_data->first()->id;
                            }
                    

                            $classe_data =Classe::select("classes.*")
                             ->join('niveaux', 'niveaux.id', '=', 'classes.id_niv')    
                             ->join('users', 'users.id', '=', 'niveaux.id_etab')
                             
                             ->where("classes.nom" , 'like', '%' . strtolower($classe) . '%')
                             ->get();

                            if($classe_data->count()<=0)
                            {
                                if(is_numeric( $niveau_insert_id))
                                {
                                    $classe_insert_id = Classe::create([
                                     'nom' =>$classe, 
                                     'id_niv' => $niveau_insert_id, 
                                     'nbre_elev' =>20,
                                     'id_etab' => Auth::id(), 
                                    ]);
                                }
                                  
                            }
                            else
                            {
                                $classe_insert_id=$classe_data->first()->id;
                            }
                            
                     /*   }
                    }
            */
                
                }
           
             


            }

            /*else {
                Session::flash('error', 'Extension '.$extension.' de fichier des niveaux/classes et invalide veuillez choisir une fichier sous les formats suivants (xlsx,xls,csv)');
                return back();
            }*/
              return redirect()->back()->with('success', 'Importation des classes effectuée avec succès');
        }

      return redirect()->back()->with('error', 'veuillez choisir une fichier sous les formats suivants (xlsx,xls,csv)');
    }

     public function import_produit(Request $request){
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        if($request->hasFile('file_prod'))
        {
            $extension = File::extension($request->file_prod->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") 
            {

                $path = $request->file_prod->getRealPath();
               

                $rows = Excel::toArray(new ProdImport, $request->file('file_prod'));
                $rows = array_filter($rows);

                for($j=1;$j<sizeof($rows[0]);$j++)
                {

                   
                    $lebelle=htmlspecialchars(addslashes(strtolower($rows[0][$j][0])));
                    $cat=htmlspecialchars(addslashes(strtolower($rows[0][$j][1])));
                    $prix_achat=htmlspecialchars(addslashes(strtolower($rows[0][$j][2])));
                    $prix_vente=htmlspecialchars(addslashes($rows[0][$j][3]));
                    $img=htmlspecialchars(addslashes($rows[0][$j][4]));
                   

                  
                                $Prod_data =Prod::where("lebelle" , strtolower($lebelle))
                                ->where('id_user', Auth::id())->first();
                                
                              

                               
                                if($Prod_data->count()<=0)
                                {
                                    //INSERT NIVEAU
                                    
                                    $cat_data =Categorie::where("nom_cat" , 'like', '%' . strtolower($id_cat) . '%' )->where("id_user" , Auth::id() )->get();
                                                        

                                    if($cat_data->count()<=0)
                                    {
                                        //INSERT NIVEAU
                                        $cat_insert_id = Categorie::create([
                                         'nom_cat' =>$niveau, 
                                         'id_user' => Auth::id(), 
                                         'type' =>"Mix"
                                        ])->id; 

                                    }
                                    else
                                    {
                                        $cat_insert_id=$cat_data->first()->id;
                                    }
                            

                                    

                                       
                                        $Prod_insert_id = Prod::create([
                                         'lebelle' =>$lebelle, 
                                         'prix_vente' =>$prix_vente,
                                         'prix_achat' =>$prix_achat,
                                         'id_user' => Auth::id(), 
                                         'img' => $img, 
                                         'id_cat'=>$cat_insert_id,
                                        ]); 

                                        
           
                                      
                                        
                                }
                                else
                                {

                                   
                                         $Prod_data->prix_vente = $prix_vente;  
                                         $Prod_data->prix_achat = $prix_achat;  
                                         $Prod_data->img = $img;  
                                         $Prod_data->save();

                                   
                                   
                                }
                                


                            }
                        }
                        

                 /*     }
                 
                }
                
                
        
              


            }*/
            /*else {
                Session::flash('error', 'Extension '.$extension.' de fichier des Prods et invalide veuillez choisir une fichier sous les formats suivants (xlsx,xls,csv)');
                return back();
            }*/ 
            return redirect()->back()->with('success', 'Importation des produit  effectuée avec succès');
        }

 
       return redirect()->back()->with('error', 'veuillez choisir une fichier sous les formats suivants (xlsx,xls,csv)');
    }

    public function importe_leves(Request $request){

        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);

        if($request->hasFile('file_eleve'))
        {
            $extension = File::extension($request->file_eleve->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") 
            {

                $path = $request->file_eleve->getRealPath();
               

                $rows = Excel::toArray(new EleveImport, $request->file('file_eleve'));
                $rows = array_filter($rows);
                

                for($j=1;$j<sizeof($rows[0]);$j++)
                {

                    
                
                    
                    $username =  $rows[0][$j][0];
                    $eleve_nom=$rows[0][$j][1];
                    $eleve_prenom=$rows[0][$j][2];
                    $classenom=$rows[0][$j][3];
                    $niveau=$rows[0][$j][4];
                 //   $age=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rows[0][$j][2])->format('Y-m-d');
                   
                   
                  
                   


                            $classe =Classe::select("classes.*")
                             ->join('niveaux', 'niveaux.id', '=', 'classes.id_niv')    
                             ->join('users', 'users.id', '=', 'niveaux.id_etab')
                             ->where("classes.nom" , 'like', '%' .$classenom. '%')
                             ->get()
                             ->first();

                            if ( $classe == null) {
                             $niveau_data =Niveau::where("Desc_niveau" , 'like', '%' . strtolower($niveau) . '%' )->where("id_etab" , Auth::id() )->get();
                                                        

                                                        if($niveau_data->count()<=0)
                                                        {
                                                            //INSERT NIVEAU
                                                            $niveau_insert_id = Niveau::create([
                                                             'Desc_niveau' =>$niveau, 
                                                             'id_etab' => Auth::id(), 
                                                             'classement' =>0
                                                            ])->id; 

                                                        }
                                                        else
                                                        {
                                                            $niveau_insert_id=$niveau_data->first()->id;
                                                        }
                                                

                                                        

                                                          
                                                                $id_classe = Classe::create([
                                                                 'nom' =>$classenom, 
                                                                 'id_niv' => $niveau_insert_id, 
                                                                 'nbre_elev' =>20,
                                                                 'id_etab' => Auth::id(), 
                                                                ])->id;
                                                           
                                                              
                                                      
                                                        
                            }else{
                              $id_classe =   $classe->id;
                             
                            }



                            $eleve_data = Eleve::where('username',$username)->where('id_class',$id_classe )->first();
                            
                         //   $dateeel = date_create($age);
                         
                            if(!$eleve_data)
                            {
                                //INSERT NIVEAU
                               

                                    $eleve_insert_id = Eleve::create([
                                     'nom' =>$eleve_nom, 
                                     'prenom' =>$eleve_prenom,
                                     'id_etab' => Auth::id(), 
                                     'id_class'=>$id_classe,
                                     'username'=>$username,
                                     'password'=>Hash::make(str_replace(' ', '_', $eleve_nom).gmdate('Y')),
                                     'img'=>'defalut.png'
                                    ])->id; 
                                    
                            }
                            else
                            {
                               
                                    $eleve_data->id_class = $classe->id; 
                                    $eleve_data->save();
                               
                            }

                            // remove classe eleve
                            // id classe nouveau excel
                           


                            //$etudiant_geted = Eleve::where("id","=",$eleve_insert_id)->first();
        
                          

                             // Archiver les actions

                            //Action::where('id_elv', '=', $eleve_insert_id)->update(['archive' => '1']);

                        }

                        }
                        

              /*     
                }
                
                
        
               


            }*/
            /*else {
                Session::flash('error', 'Extension '.$extension.' de fichier des eleves et invalide veuillez choisir une fichier sous les formats suivants (xlsx,xls,csv)');
                return back();
            }*/
             return redirect()->back()->with('success', 'Importation des élèves effectuée avec succès');
        }

         
        return redirect()->back()->with('error', 'veuillez choisir une fichier sous les formats suivants (xlsx,xls,csv)');

    }
    


   
}
