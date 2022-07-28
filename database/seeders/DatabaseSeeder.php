<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'role' => 'admin',
            'phone' => '0123456789',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'passcode' => password_hash('12345678', PASSWORD_DEFAULT),
            'invite_code' => 'ABCD1234'
        ]);
        DB::table('settings')->insert([
            'homepage_images' => '[]',
            'teampage' => '',
            'vippage' => '',
            'introducepage' => ''
        ]);
    }
}
