<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferingSeeder extends Seeder
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

        $offerings = [
            [
                'qv_offering_id' =>
                    'PO_SAYXNRM_CT_750_750Mi_1500Mi_5000M_250_250SMS_30D_NR',
                'name' => '5GB',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>WiFi para compartir</li><li>Asistencia y seguros Premium</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 290,
                'brand_id' => 3,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAYXN_CT_750_750Mi_1500Mi_3000_5000M_250_250SMS_30D_NR',
                'name' => '8GB',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>WiFi para compartir</li><li>Asistencia y seguros Premium</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 360,
                'brand_id' => 3,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAYXNST750_750Mi_1500Mi_15000_5000M_500_500SMS_20000T_30',
                'name' => '20GB',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>Asistencia y seguros Premium</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 440,
                'brand_id' => 3,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAYXNRM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR',
                'name' => '20GB',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>WiFi para compartir</li><li>Asistencia y seguros Premium</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 585,
                'brand_id' => 3,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAYXNRM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_NR',
                'name' => '50GB',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>WiFi para compartir</li><li>Asistencia y seguros Premium</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 895,
                'brand_id' => 3,
                'is_active' => true
            ]
        ];

        foreach ($offerings as $offering) {
            DB::table('offerings')->insert([
                'qv_offering_id' => $offering['qv_offering_id'],
                'name' => $offering['name'],
                'description' => $offering['description'],
                'promotion' => $offering['promotion'],
                'price' => $offering['price'],
                'brand_id' => $offering['brand_id'],
                'is_active' => $offering['is_active'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
