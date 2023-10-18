<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UserAdminOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void 
    {
        //Adds the root admin to the Users table.
        DB::table("users")->insert([
            "name" => "root",
            "email" => "test@mail.com",
            "password" => Hash::make("horizonCollege"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
            "is_operator" => false,
            "is_admin" => true,
        ]);
    }
}
