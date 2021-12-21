<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'              => 'Super Admin',
                'email'             => 'sampahe57@gmail.com',
                'password'          => bcrypt('Iniadalahpassword123.'),
                'email_verified_at' => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($data);
    }
}