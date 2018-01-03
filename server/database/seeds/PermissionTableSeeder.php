<?php
/**
 * Created by PhpStorm.
 * User: hao.nguyen
 * Date: 1/3/2018
 * Time: 11:20 AM
 */

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    public function run() {
        $lstPermission = array(
            'Game', 'Agency', 'User', 'Revenue', 'Full'
        );

        foreach ($lstPermission as $per) {
            \App\Models\Permission::create(array(
                'name' => $per
            ));
        }
    }
}