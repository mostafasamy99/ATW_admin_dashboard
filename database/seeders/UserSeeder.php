<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create($this->adminData());
    }
    public function adminData()
    {
        return
        [
            'name'=>'admin',
                'email'=>'admin@admin.com',
                'password' => Hash::make('password'),
                'is_admin'=>'1',
        ];
    }
}
