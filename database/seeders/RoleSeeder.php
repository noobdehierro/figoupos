<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        $roles = [
            [
                'name' => 'Super Administrator'
            ],
            [
                'name' => 'Administrator'
            ],
            [
                'name' => 'AAA Distributor'
            ],
            [
                'name' => 'Distributor'
            ],
            [
                'name' => 'Seller'
            ],
            [
                'name' => 'Limited'
            ]
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
