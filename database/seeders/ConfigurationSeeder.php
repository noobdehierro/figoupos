<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
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

        $configurations = [
            [
                'label' => 'Sandbox',
                'code' => 'is_sandbox',
                'value' => 'true',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'Notifications Email',
                'code' => 'notifications_email',
                'value' => 'roberto.guzman@leancommerce.mx',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'Copomex Token',
                'code' => 'copomex_token',
                'value' => '5b2e78a0-7c7a-4343-a684-64913f730fce',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'Altan Auth Endpoint',
                'code' => 'altan_auth_endpoint',
                'value' =>
                    'https://altanredes-prod.apigee.net/v1/oauth/accesstoken',
                'group' => 'Altan',
                'is_protected' => true
            ],
            [
                'label' => 'Altan Token',
                'code' => 'altan_token',
                'value' =>
                    'MkdhcmtpenN1Y1d5ajVmRk5aQUNyQWY0d1RuZnEwYWY6a2JDQUVRTW05N3VlR3diRQ',
                'group' => 'Altan',
                'is_protected' => true
            ],
            [
                'label' => 'Altan Device Info Endpoint',
                'code' => 'altan_device_info_endpoint',
                'value' =>
                    'https://altanredes-prod.apigee.net/cm-360/v1/subscribers/getDeviceInformation',
                'group' => 'Altan',
                'is_protected' => true
            ],
            [
                'label' => 'Altan Default Identificator',
                'code' => 'altan_identificator',
                'value' => 'imei',
                'group' => 'Altan',
                'is_protected' => true
            ],
            [
                'label' => 'Qvantel Offering Endpoint',
                'code' => 'qvantel_offering_endpoint',
                'value' =>
                    'https://api-figou-prod.qvantel.solutions/uc/v1/offerings',
                'group' => 'Qvantel',
                'is_protected' => true
            ],
            [
                'label' => 'Qvantel Offering Endpoint Sandbox',
                'code' => 'qvantel_offering_endpoint_sandbox',
                'value' =>
                    'https://mapp-sayco-preprod.qvantel.systems/uc/v1/offerings',
                'group' => 'Qvantel',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Public API Key',
                'code' => 'conekta_public_api_key',
                'value' => 'key_ZR2XVAqpQ94q6idcdCikjGw',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Private API Key',
                'code' => 'conekta_private_api_key',
                'value' => 'key_yQjT6EzehaJ5kP97xsiTZg',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Public API Key Sandbox',
                'code' => 'conekta_public_api_key_sandbox',
                'value' => 'key_PxykS51XqUuC2AkyqkyHsKw',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Private API Key Sandbox',
                'code' => 'conekta_private_api_key_sandbox',
                'value' => 'key_Lt9L1PSxYzirGhryU6RHQA',
                'group' => 'Payment',
                'is_protected' => true
            ]
        ];

        foreach ($configurations as $configuration) {
            DB::table('configurations')->insert([
                'label' => $configuration['label'],
                'code' => $configuration['code'],
                'value' => $configuration['value'],
                'group' => $configuration['group'],
                'is_protected' => $configuration['is_protected'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
