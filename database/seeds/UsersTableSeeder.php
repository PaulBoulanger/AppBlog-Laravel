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
        factory(App\User::class, 3)->create();
        DB::table('users')->insert(
            [
                [
                    'name' => 'Jean',
                    'email' => 'jean@mail.fr',
                    'password' => Hash::make('poule')
                ],
                [
                    'name' => 'Bono',
                    'email' => 'Bono@mail.fr',
                    'password' => Hash::make('poule')
                ],
            ]

        );
    }
}
