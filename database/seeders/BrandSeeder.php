<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrandSeeder extends Seeder
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

        $brands = [
            [
                'parent_id' => null,
                'name' => 'Figou',
                'description' => 'Marca principal de IGOU',
                'is_primary' => true,
                'is_active' => true
            ],
            [
                'parent_id' => 1,
                'name' => 'DiDi',
                'description' => 'Alianza para repartidores DiDi Food',
                'is_primary' => true,
                'is_active' => true
            ],
            [
                'parent_id' => 1,
                'name' => 'Xnosotras',
                'description' => 'Alianza Xnosotras',
                'is_primary' => true,
                'is_active' => true
            ],
            [
                'parent_id' => 1,
                'name' => 'Catemovil',
                'description' => 'Sindicato de trabajadores Catem',
                'is_primary' => true,
                'is_active' => true
            ]
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'parent_id' => $brand['parent_id'],
                'name' => $brand['name'],
                'description' => $brand['description'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'is_primary' => $brand['is_primary'],
                'is_active' => $brand['is_active']
            ]);
        }
    }
}
