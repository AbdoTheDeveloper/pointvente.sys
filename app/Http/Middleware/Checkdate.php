<?php

namespace App\Http\Middleware;

use Closure;
use File;
use DateTime;
use App\Model\serial_code;
class Checkdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


      // $date1 = new DateTime(File::get(storage_path('app/texte.txt')));
      // $date2 = new DateTime("2019-01-01");
      // $datesys = new DateTime(date('Y-m-d'));
      // $interval = $date1->diff($date2);
      // $insys = $date1->diff($datesys);

if(serial_code::validateDate(serial_code::decrypter(serial_code::selectCode()->valeur_key, serial_code::selectMaxSerial()->code)) != 1 || 
   (date("y-m-d", strtotime(serial_code::decrypter(serial_code::selectCode()->valeur_key, serial_code::selectMaxSerial()->code)))) <= date("y-m-d")) {

       return redirect('/reparation');
        
                  
       }
  
        return $next($request);
    }
}
