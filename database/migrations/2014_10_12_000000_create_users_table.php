<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nom');
            $table->string('email');
            $table->string('username');
            $table->text('password');
            $table->string('adress'); 
            $table->string('tele'); 
            $table->string('contact'); 
            $table->string('logo'); 
            $table->string('color'); 
            $table->string('gard'); 	
            $table->integer('p_frns');
            $table->integer('p_eleve');
            $table->integer('p_trav');
            $table->integer('p_stock');
            $table->integer('p_art');
            $table->integer('p_cat');
            $table->integer('p_class');
            $table->integer('p_niv');
            $table->integer('p_recette');
            $table->integer('p_para');
            $table->integer('p_save');
            $table->integer('p_users');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('users')->insert([
              'nom' => 'admin',
              'username' => 'admin',
              'email' => 'admin@gmail.com',
              'password' => bcrypt('admin'),
              'gard' => 'admin',
              "p_frns" => 1,
              "p_eleve" => 1,
              "p_trav" => 1,
              "p_stock" => 1,
              "p_art" => 1,
              "p_cat" => 1,
              "p_class" => 1,
              "p_niv" => 1,
              "p_recette" => 1,
              "p_para" => 1,
              "p_save" => 1,
              "p_users" => 1,
          ]);
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
