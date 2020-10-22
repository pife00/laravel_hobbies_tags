<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Felipe',
            'email' => 'imapife00@gmail.com',
            'password' => Hash::make('123456789'), 
            'remember_token' => Str::random(10),
            'role'=>'admin'
        ]);
        
        $admin->save();
    }
}
