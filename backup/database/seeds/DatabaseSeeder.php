<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         

        DB::table('serial_code')->insert([
                           
                           'code' => 'apJrZJFgmmBpcA==',
                       ]);
        DB::table('societe')->insert([
                    
                    'valeur_key' => '4c927cb6a2ca24f314257b1db669fdaf',
                ]);

    }
}
