<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->firstOrCreate(['email' => 'student1@dev.com'], [
            'password' => Hash::make('stud%100'),
            'name' => 'student_1',
        ]);

        $admin->assignRole(RoleEnum::student->value);
    }
}
