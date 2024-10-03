<?php

namespace Database\Seeders;

use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRepository = app()->make(UserRepositoryInterface::class);
        $array = [
            [
                'name' => 'System admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
            ],
        ];
        foreach ($array as $key => $item) {
            if (!$userRepository->existsByColumn(['email' => $item['email']])) {
                $userRepository->create($item);
            }
        }
    }
}
