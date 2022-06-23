<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailSeeder extends Seeder
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

        $mails = [
            [
                'description' => 'Default configuration',
                'brand_id' => '1',
                'driver' => 'smtp',
                'host' => 'smtp.googlemail.com',
                'port' => '465',
                'username' => 'figou.notifica@gmail.com',
                'password' => 'lrSvi2xeOY5N',
                'encryption' => 'ssl',
                'from_address' => 'notificaciones@igou.com',
                'from_name' => 'POS | IGOU TELECOM'
            ]
        ];

        foreach ($mails as $mail) {
            DB::table('mails')->insert([
                'description' => $mail['description'],
                'brand_id' => $mail['brand_id'],
                'driver' => $mail['driver'],
                'host' => $mail['host'],
                'port' => $mail['port'],
                'username' => $mail['username'],
                'password' => $mail['password'],
                'encryption' => $mail['encryption'],
                'from_address' => $mail['from_address'],
                'from_name' => $mail['from_name'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
