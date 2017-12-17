<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(array(
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('123456'),
            'role' => 1,
        ));
        
        factory(App\Models\User::class, 50)->create();
    }
}
