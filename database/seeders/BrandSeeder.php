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
                'name' => 'Figou',
                'description' => 'Marca principal de IGOU',
                'is_active' => true
            ],
            [
                'name' => 'DiDi',
                'description' => 'Alianza para repartidores DiDi Food',
                'is_active' => true
            ],
            [
                'name' => 'Xnosotras',
                'description' => 'Alianza Xnosotras',
                'is_active' => true
            ],
            [
                'name' => 'Catemovil',
                'description' => 'Sindicato de trabajadores Catem',
                'is_active' => true
            ]
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand['name'],
                'description' => $brand['description'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'is_active' => $brand['is_active']
            ]);
        }
    }
}
