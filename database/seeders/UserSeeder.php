<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User,role,permission};
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name'=>'user','password'=>bcrypt('password')],
            ['name'=>'Author','password'=>bcrypt('password')],
            ['name'=>'Editor','password'=>bcrypt('password')]
        ]);
    }
}
