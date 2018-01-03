<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UserDetails::class,20)->create();
    }
}
