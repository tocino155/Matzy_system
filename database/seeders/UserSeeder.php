<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //agregar usuarios
        DB::table('users')->insert(
           [ 
               'name'=>"ADMINISTRADOR",
               'email'=>"admin@gmail.com",
               'foto'=>"https://picsum.photos/300/300",
               'password'=>bcrypt('12345678'),
           ]);
    }
}
