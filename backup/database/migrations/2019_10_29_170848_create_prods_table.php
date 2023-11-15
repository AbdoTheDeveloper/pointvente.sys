<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->integer('id_cat');
            $table->double('prix_achat');
            $table->double('prix_vente');
            
            $table->string('lebelle');
            $table->string('code_bar');
            $table->string('unite');
            
            $table->text('img')->nullable();
            $table->integer('type')->nullable();
            $table->integer('qte')->default(0);
            $table->integer('qte_alert')->default(10);
            
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
        Schema::dropIfExists('prods');
    }
}
