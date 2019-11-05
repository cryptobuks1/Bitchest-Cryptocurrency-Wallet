<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

/*
|--------------------------------------------------------------------------
| Création de mes fauses utilisateurs via les seeder 
|--------------------------------------------------------------------------
*/
        $users = factory(App\User::class, 6)->create();
       
        DB::Table('users')->insert(array([
                'name' => 'Elhadji',
                'email' => 'damediagnea@gmail.com',
                'password' => Hash::make('admin'),
                'status' => rand(0, 1)
            ],

            [
                'name' => 'Cheikh',
                'email' => 'cheikh@gmail.com',
                'password' => Hash::make('cheikh'),
                'status' => rand(0, 1)
            ],

            [
                'name' => 'Ousmane',
                'email' => 'ousmane@gmail.com',
                'password' => Hash::make('ousmane'),
                'status' => rand(0, 1)
            ],

            [
                'name' => 'Pavel',
                'email' => 'pavel@gmail.com',
                'password' => Hash::make('pavel'),
                'status' => rand(0, 1)
            ],

            [
                'name' => 'David',
                'email' => 'david@gmail.com',
                'password' => Hash::make('david'),
                'status' => rand(0, 1)
            ],


            [
                'name' => 'Clement',
                'email' => 'clement@gmail.com',
                'password' => Hash::make('clement'),
                'status' => rand(0, 1)
            ]));


    }
}
