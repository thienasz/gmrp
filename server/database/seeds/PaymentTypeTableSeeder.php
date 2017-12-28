<?php

use Illuminate\Database\Seeder;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\App\Models\PaymentType::all()->count() == 0){
            factory(App\Models\PaymentType::class, 3)->create();
        }
    }
}
