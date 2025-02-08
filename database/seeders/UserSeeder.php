<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for($i=2; $i<=10; $i++){
        //     User::create([
        //         'name'=>'Пользовател'.$i,
        //         'login'=>str_pad($i,6,"0",STR_PAD_LEFT),
        //         'password'=>bcrypt('password'),
        //     ]);
        // }
    }
}
