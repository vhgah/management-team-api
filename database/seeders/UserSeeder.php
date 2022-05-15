<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create basic users.
        $userFirst = User::firstOrCreate([
            'name'              => 'Admin First',
            'email'             => 'admin_first@gmail.com'
        ], [
            'email_verified_at' => now(),
            'password'          => '123456',
        ]);

        $userSecond = User::firstOrCreate([
            'name'              => 'Admin Second',
            'email'             => 'admim_second@gmail.com'
        ], [
            'email_verified_at' => now(),
            'password'          => '123456',
        ]);

        // Create tokens for easy testing.
        // User token = {tokenId}|12345 and {tokenId}|123456.
        $userFirst->tokens()->create(['name' => 'Default', 'token' => hash('sha256', 12345), 'abilities' => ['*']]);
        $userSecond->tokens()->create(['name' => 'Default', 'token' => hash('sha256', 123456), 'abilities' => ['*']]);
    }
}
