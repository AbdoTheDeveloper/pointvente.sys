<?php
namespace App\Http\Controllers;
use Alert;
use Illuminate\Http\Request;
use Artisan;
use Log;
use Storage;
use App\Model\Backup;
use Redirect;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class BackupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admins');
         ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
    }


    public function index()
    {   
        $backups=Backup::all();
        return view("Admin.backup.backups")->with(compact('backups'));

    }
    public function create()
    {
        $backup = new Backup();
        $file=$backup->dump_MySQLi();

        $backup = Backup::create([
                    'fichier'=>$file,
                ]); 

        return Redirect::back();
        
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($id)
    {

       
        $backup_geted = Backup::where("id","=",$id)->first();

       if(isset($backup_geted)):
            $file = public_path()."/backup/".$backup_geted->fichier;
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );

            return Response::download($file, $backup_geted->fichier,$headers);
        endif;

        return Redirect::back();

        
    }
    /**
     * Deletes a backup file.
     */
    public function delete($id)
    {
       

        $backup_geted = Backup::where("id","=",$id)->first();

        $file_path = app_path().'/backup/'.$backup_geted->fichier;
        if (is_file( $file_path)) {
            unlink($file_path);
        }  

        Backup::where("id","=",$id)->delete();
        
        \Session::flash('message', 'Suppression effectuée !!'); 

       return Redirect::back();

    }
}