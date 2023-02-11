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
                    'PO_BO-RM_ST_250_250Mi_3750_1250M_125_125SMS_5000T_7D_NR',
                'name' => 'BO 5GB',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>Vigencia: 7 días</li></ul>',
                'promotion' => '',
                'price' => 75,
                'seller_price' => 75,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_ST_500_500Mi_7500_2500M_250_250SMS_10000T_15D_NR',
                'name' => 'BO 10GB',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>10GB de 5G-4G LTE</li><li>10GB extra en velocidad reducida</li><li>Vigencia: 15 días</li></ul>',
                'promotion' => '',
                'price' => 125,
                'seller_price' => 125,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_750_750Mi_5000M_250_250SMS_30D_NR',
                'name' => 'BO 5GB / 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 159,
                'seller_price' => 159,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_750_750Mi_5000M_250_250SMS_30D_NR',
                'name' => 'BO 5GB / 1 mes +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 239,
                'seller_price' => 239,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_750_750Mi_3000_5000M_250_250SMS_30D_NR',
                'name' => 'BO 8GB / 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>8GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 209,
                'seller_price' => 209,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_750_750Mi_3000_5000M_250_250SMS_30D_NR',
                'name' => 'BO 8GB / 1 mes +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>8GB de 5G-4G LTE</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 289,
                'seller_price' => 289,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR',
                'name' => 'BO 20GB / 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 269,
                'seller_price' => 269,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR',
                'name' => 'BO 20GB / 1 mes +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 349,
                'seller_price' => 349,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR',
                'name' => 'BO 20GB Plus / 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 389,
                'seller_price' => 389,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR',
                'name' => 'BO 20GB Plus / 1 mes +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 469,
                'seller_price' => 469,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_NR',
                'name' => 'BO 50GB / 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>50GB de 5G-4G LTE</li><li>50GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 599,
                'seller_price' => 599,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_NR',
                'name' => 'BO 50GB / 1 mes +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>50GB de 5G-4G LTE</li><li>50GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 679,
                'seller_price' => 679,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_750_750Mi_5000_250_250SMS_6M_R',
                'name' => 'BO 5GB / 6 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 699,
                'seller_price' => 699,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_750_750Mi_5000_250_250SMS_6M_R',
                'name' => 'BO 5GB / 6 meses +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 1179,
                'seller_price' => 1179,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R',
                'name' => 'BO 20GB / 6 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 1199,
                'seller_price' => 1199,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R',
                'name' => 'BO 20GB / 6 meses +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 1679,
                'seller_price' => 1679,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R',
                'name' => 'BO 20GB Plus / 6 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 1699,
                'seller_price' => 1699,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R',
                'name' => 'BO 20GB Plus / 6 meses +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 2179,
                'seller_price' => 2179,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_750_750Mi_5000_250_250SMS_12M_R',
                'name' => 'BO 5GB / 12 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 1399,
                'seller_price' => 1399,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_750_750Mi_5000_250_250SMS_12M_R',
                'name' => 'BO 5GB / 12 meses +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 2359,
                'seller_price' => 2359,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R',
                'name' => 'BO 20GB / 12 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 2299,
                'seller_price' => 2299,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R',
                'name' => 'BO 20GB / 12 meses +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 3259,
                'seller_price' => 3259,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BO-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R',
                'name' => 'BO 20GB Plus / 12 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 3299,
                'seller_price' => 3299,
                'brand_id' => 5,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_BON-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R',
                'name' => 'BO 20GB Plus / 12 meses +Beneficios',
                'description' =>
                    '<ul><li>Beneficios BO</li><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>WiFi para compartir</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 4259,
                'seller_price' => 4259,
                'brand_id' => 5,
                'is_active' => true
            ],
            
        ];

        foreach ($offerings as $offering) {
            DB::table('offerings')->insert([
                'qv_offering_id' => $offering['qv_offering_id'],
                'name' => $offering['name'],
                'description' => $offering['description'],
                'promotion' => $offering['promotion'],
                'price' => $offering['price'],
                'seller_price' => $offering['seller_price'],
                'brand_id' => $offering['brand_id'],
                'is_active' => $offering['is_active'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
