<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     //Vaciar la tabla.
     Usuario::truncate();

     $faker= \Faker\Factory::create();

     //Crear usuarios fictisios en la tabla
     for($i =0; $i < 50; $i++){
      Usuario::create([
      'nombre' =>$faker->sentence, 
      'apellidos'=> $faker->paragraph,

      ]);
    }  
    }
}
