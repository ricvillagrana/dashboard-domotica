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
        // $this->call(UsersTableSeeder::class);

        date_default_timezone_set("America/Mexico_City");
        // Creating admin user
        DB::table('users')->insert([
            'username'  => 'admin',
            'name'      => 'Ricardo',
            'lastname'  => 'Villagrana',
            'password'  => bcrypt('admin'),
            'superuser' => true,
            'created_at'    => date("Y/m/d h:i:sa")
        ]);

        // Creating main actions
        DB::table('actions')->insert([
            'name'          => 'Temperatura',
            'description'   => 'Ajustar temperatura de manera automática (La temperatura establecida en el perfil).',
            'created_at'    => date("Y/m/d h:i:sa")
        ]);
        DB::table('actions')->insert([
            'name'          => 'Compartir temperatura del exterior',
            'description'   => 'Dejar que la ventana se abara si la temperatura exterior es adecuada.',
            'created_at'    => date("Y/m/d h:i:sa")
        ]);
        DB::table('actions')->insert([
            'name'          => 'Luces nocturnas',
            'description'   => 'Encender luces cuando bajes de la cama.',
            'created_at'    => date("Y/m/d h:i:sa")
        ]);
        DB::table('actions')->insert([
            'name'          => 'Luces automáticas',
            'description'   => 'Encender luces de manera automática cuando no haya suficiente luz exterior.',
            'created_at'    => date("Y/m/d h:i:sa")
        ]);
    }
}
