<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Payment::class, 50)->create();
    }
}
