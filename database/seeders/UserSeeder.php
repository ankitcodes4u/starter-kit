<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => Hash::make('test1234'),
            ]
        );

        $user->syncRoles(['super_admin']);
    }
}
