<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_trav');
            $table->integer('id_operation');
            $table->string('id_prod');
            $table->double('prix');
            $table->integer('qte_prod');
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
        Schema::dropIfExists('detail_operations');
    }
}
