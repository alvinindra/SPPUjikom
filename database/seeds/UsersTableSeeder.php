<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_users'    => 'Administrator',
            'username'      => 'administrator',
            'password'      => Hash::make('admin4321'),
            'email'         => 'administrator@sppujikom.com',
            'level'         => 'administrator',
            'api_token'     => Str::random(100),
            'created_at'    => now()
        ]);

        User::create([
            'nama_users'    => 'Petugas',
            'username'      => 'petugas',
            'password'      => Hash::make('petugas4321'),
            'email'         => 'petugas@sppujikom.com',
            'level'         => 'petugas',
            'api_token'     => Str::random(100),
            'created_at'    => now()
        ]);
    }
}
