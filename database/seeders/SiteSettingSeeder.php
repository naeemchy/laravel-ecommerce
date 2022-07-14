<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->insert([
            'email_one' => Str::random(10).'@gmail.com',
            'email_two' => Str::random(10).'@gmail.com',
            'phone_one' => '01234567890',
            'phone_two' => '09876543210',
            'address_one' => Str::random(10),
            'address_two' => Str::random(10),
            'city' => Str::random(10),
            'country' => Str::random(10),
            'logo' => 'default.png',
            'about' => Str::random(100),
        ]);
    }
}
