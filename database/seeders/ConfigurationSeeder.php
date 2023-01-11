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
                'label' => 'Copomex Endpoint',
                'code' => 'copomex_endpoint',
                'value' => 'https://api.copomex.com/query/info_cp/',
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
                'label' => 'Qvantel Baskets Endpoint',
                'code' => 'qvantel_baskets_endpoint',
                'value' =>
                'https://api-figou-prod.qvantel.solutions/uc/v0/v3/baskets/',
                'group' => 'Qvantel',
                'is_protected' => true
            ],
            [
                'label' => 'Qvantel Baskets Endpoint Sandbox',
                'code' => 'qvantel_baskets_endpoint_sandbox',
                'value' =>
                'https://mapp-sayco-preprod.qvantel.systems/uc/v0/v3/baskets/',
                'group' => 'Qvantel',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Public API Key',
                'code' => 'conekta_public_api_key',
                'value' => 'key_RyfzzgmQx4rM12VjYEmfwGw',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Private API Key',
                'code' => 'conekta_private_api_key',
                'value' => 'key_z2zJre7mpoyWT3DR8qwCfw',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Public API Key Sandbox',
                'code' => 'conekta_public_api_key_sandbox',
                'value' => 'key_F6vgsqYFZXnzxMUpXVCoWpw',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Private API Key Sandbox',
                'code' => 'conekta_private_api_key_sandbox',
                'value' => 'key_gEmx4y9RkpQmqADqqxy1zw',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Openpay Merchant ID Sandbox',
                'code' => 'openpay_merchant_id_sandbox',
                'value' => 'm2j4m875mooh87bjxhzv',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Openpay Private Key Sandbox',
                'code' => 'openpay_private_key_sandbox',
                'value' => 'sk_25a16f3b4d9b40c9943c064049aa4060',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Conekta Public API Key Sandbox',
                'code' => 'openpay_public_key_sandbox',
                'value' => 'pk_6ec233a43c294377a2a6b9016acdcb23',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Openpay Merchant ID',
                'code' => 'openpay_merchant_id',
                'value' => 'm9awzr1utinzflc89siw',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Openpay Private Key',
                'code' => 'openpay_private_key',
                'value' => 'sk_b0384dca105e4b4989fe4c2712ffd737',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'Openpay Public API Key',
                'code' => 'openpay_public_key',
                'value' => 'pk_8dcd63b64cbe4f019bd8222263564431',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'SAYCO - external payment and onboarding preprod Endpoint',
                'code' => 'external_payment_and_onboarding_preprod_endpoint',
                'value' =>
                'https://public-webhook-sayco-preprod.qvantel.systems/api/onboarding/customer',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'SAYCO - external payment and onboarding Prod API Key',
                'code' => 'external_payment_and_onboarding_Prod_key',
                'value' => 'Basic YWRtaW46YWRtaW4=',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'SAYCO - external payment and onboarding prod Endpoint',
                'code' => 'external_payment_and_onboarding_prod_endpoint',
                'value' =>
                'https://public-webhook-figou-prod.qvantel.solutions/api/onboarding/customer',
                'group' => 'Payment',
                'is_protected' => true
            ],
            [
                'label' => 'SAYCO - external payment and onboarding preprod API Key',
                'code' => 'external_payment_and_onboarding_preprod_key',
                'value' => 'Basic YWRtaW46YWRtaW4=',
                'group' => 'Payment',
                'is_protected' => true
            ],

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