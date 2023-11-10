<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->bigIncrements('id');

 

            $table->integer('id_etab');
            $table->integer('id_class');
            $table->string('nom')->nullable(); 
            $table->date('age')->nullable(); 
            $table->string('prenom')->nullable(); 
            $table->text('adress')->nullable(); 
            $table->text('tele')->nullable(); 
            $table->string('email')->nullable();
            $table->string('username');  
            
            $table->string('password');
            $table->string('img')->nullable();
            $table->double('sold_r')->nullable();
            $table->double('sold_b')->nullable();
            $table->rememberToken();
            $table->softDeletes();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleves');
    }
}
