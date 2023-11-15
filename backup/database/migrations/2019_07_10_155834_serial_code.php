<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SerialCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('serial_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->timestamps();
        });

           DB::table('serial_code')->insert([
                           
                           'code' => 'apJrZJFgmmBpcA==',
                       ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('serial_code');
    }
}
