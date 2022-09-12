<?php

namespace Database\Seeders;

use App\Services\EmagService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name'              => 'Test User',
            'email'             => 'test@user.test',
            'email_verified_at' => now(),
            'password'          => Hash::make('SecretPass'),
            'remember_token'    => Str::random(10),
        ]);
        EmagService::seeder($user);
    }
}
