<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AgencyTableSeeder::class);
        $this->call(PaymentTypeTableSeeder::class);
        $this->call(GameTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserDetailsSeeder::class);


        $this->call(PaymentTableSeeder::class);
        $this->call(GameSessionTrackerTableSeeder::class);
        $this->call(NewRegisterTrackerTableSeeder::class);
    }
}
