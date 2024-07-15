<?php

namespace Database\Seeders;

use App\Models\License;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        User::create(
            [
            'type' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '01022706140',
            'password' => Hash::make('123456'),
        ],
        );

        User::create(

            [
                'type' => 'user',
                'name' => 'user 1',
                'email' => 'user@user.com',
                'phone' => '01022706145',
                'password' => Hash::make('123456'),
            ],
        );
    }
}
