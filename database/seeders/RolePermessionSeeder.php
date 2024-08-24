<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner',
        ]);
        $studentRole = Role::create([
            'name' => 'student',
        ]);
        $teacherRole = Role::create([
            'name' => 'teacher',
        ]);

        //akun superadmin untuk mengelola data awal
        $userOwner = User::create([
            'name' => 'Raul Mahya',
            'occupation' => 'Educator',
            'avatar' => 'images/default-avatar.png',
            'email' => 'raulmahya@berkemah.com',
            'password' => bcrypt('raulmahya')
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
