<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'Divya sree',
            'email'             => 'drama001@odu.edu',
            'password'          =>  Hash::make('password'),
            'remember_token'    =>  Str::random(10),
            'verification_code' =>  Str::random(10),
            // //'is_verified'       =>  
            
        ]);
    }
}
