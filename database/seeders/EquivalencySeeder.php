<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquivalencySeeder extends Seeder
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

        $equivalencies = [
            
            [	"qv_offering_id" =>	"PO_SAY_RM_ST_125_125Mi_1500_500M_50_75SMS_2000T_3D_SS",	"altan_offering_id" =>	"1879958001"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_ST_250_250Mi_3750_1250M_125_125SMS_5000T_7D_SS",	"altan_offering_id" =>	"1879958002"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_ST_500_500Mi_7500_2500M_250_250SMS_10000T_15D_SS",	"altan_offering_id" =>	"1879958003"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_30D_SS",	"altan_offering_id" =>	"1879958004"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_SS",	"altan_offering_id" =>	"1809958029"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_CT_750_750Mi_5000M_250_250SMS_30D_SS",	"altan_offering_id" =>	"1809958028"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_SS",	"altan_offering_id" =>	"1809958030"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_CT_NB28_750_750Mi_1000M_250_250SMS_300RS_30D_SS",	"altan_offering_id" =>	"1809858003"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_CT_NB28_750_750Mi_2000M_500_500SMS_500RS_30D_SS",	"altan_offering_id" =>	"1809858004"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_CT_NB28_750_750Mi_4000M_500_500SMS_2000RS_30D_SS",	"altan_offering_id" =>	"1809858005"	],
            [	"qv_offering_id" =>	"PO_SAY_RM_CT_750_750Mi_3000_5000M_250_250SMS_30D_SS",	"altan_offering_id" =>	"1809958031"	],

        ];

        foreach ($equivalencies as $equivalency) {
            DB::table('equivalencies')->insert([
                'qv_offering_id' => $equivalency['qv_offering_id'],
                'altan_offering_id' => $equivalency['altan_offering_id'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
