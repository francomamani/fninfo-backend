<?php

use Illuminate\Database\Seeder;
use App\Categoria;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombres' => 'ROOT',
            'apellidos' => 'SUPER ADMINISTRADOR',
            'cuenta' => 'root',
            'carnet' => '123456789',
            'password' => Hash::make('Root123$$')
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
