<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Societe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valeur_key')->nullable();
            $table->timestamps();
        });

        DB::table('societe')->insert([
                    
                    'valeur_key' => '4c927cb6a2ca24f314257b1db669fdaf',
                ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('societe');
    }
}
