<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use DateTime;
class serial_code extends Model {
   protected $id;
   protected $code;
   protected $date_activation;

   public static function selectMaxSerial() {
      $result =  collect(DB::select("SELECT code from serial_code where  id = 1 "))->first();
      return $result;
   }

   public static function selectCode() {
       $result =  collect(DB::select("SELECT valeur_key from societe where  id = 1 "))->first();
     return $result;
   }


   public static function validateDate($date, $format = 'Y-m-d') {
      $d = DateTime::createFromFormat($format, $date);

      return $d && $d->format($format) == $date;
   }

   public static function crypter($maCleDeCryptage = "", $maChaineACrypter) {
      if($maCleDeCryptage == "") {
         $maCleDeCryptage = $GLOBALS['_COOKIE']['PHPSESSID'];
      }
      $maCleDeCryptage = md5($maCleDeCryptage);
      $letter = -1;
      $newstr = '';
      $strlen = strlen($maChaineACrypter);
      for($i = 0; $i < $strlen; $i++) {
         $letter++;
         if($letter > 31) {
            $letter = 0;
         }
         $neword = ord($maChaineACrypter{$i}) + ord($maCleDeCryptage{$letter});
         if($neword > 255) {
            $neword -= 256;
         }
         $newstr .= chr($neword);
      }
      return base64_encode($newstr);
   }

   public static function decrypter($maCleDeCryptage = "", $maChaineCrypter) {
      if($maCleDeCryptage == "") {
         /*echo "<pre>";
         print_r($GLOBALS);
            echo "</pre>";*/
         $maCleDeCryptage = $GLOBALS['_COOKIE']['PHPSESSID'];
      }


      $maCleDeCryptage = md5($maCleDeCryptage);

      $letter = -1;
      $newstr = '';

      $maChaineCrypter = base64_decode($maChaineCrypter);

      $strlen = strlen($maChaineCrypter);
      for($i = 0; $i < $strlen; $i++) {
         $letter++;
         if($letter > 31) {
            $letter = 0;
         }
         $neword = ord($maChaineCrypter{$i}) - ord($maCleDeCryptage{$letter});
         if($neword < 1) {
            $neword += 256;
         }
         $newstr .= chr($neword);
      }

      return $newstr;
   }


}

?>