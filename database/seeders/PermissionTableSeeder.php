<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'dashboard.view',
                'group' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'users.view',
                'group' => 'users',
            ],
            [
                'id' => 3,
                'name' => 'users.create',
                'group' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'users.edit',
                'group' => 'users',
            ],
            [
                'id' => 5,
                'name' => 'users.delete',
                'group' => 'users',
            ],
            [
                'id' => 6,
                'name' => 'users.toggle_status',
                'group' => 'users',
            ],
            [
                'id' => 7,
                'name' => 'users.change_password',
                'group' => 'users',
            ],
            [
                'id' => 8,
                'name' => 'departments.view',
                'group' => 'departments',
            ],
            [
                'id' => 9,
                'name' => 'departments.create',
                'group' => 'departments',
            ],
            [
                'id' => 10,
                'name' => 'departments.edit',
                'group' => 'departments',
            ],
            [
                'id' => 11,
                'name' => 'departments.delete',
                'group' => 'departments',
            ],
            [
                'id' => 12,
                'name' => 'roles.view',
                'group' => 'roles',
            ],
            [
                'id' => 13,
                'name' => 'roles.create',
                'group' => 'roles',
            ],
            [
                'id' => 14,
                'name' => 'roles.edit',
                'group' => 'roles',
            ],
            [
                'id' => 15,
                'name' => 'roles.delete',
                'group' => 'roles',
            ],
            [
                'id' => 16,
                'name' => 'roles.assign',
                'group' => 'roles',
            ],
            [
                'id' => 17,
                'name' => 'contests.view',
                'group' => 'contests',
            ],
            [
                'id' => 18,
                'name' => 'contests.create',
                'group' => 'contests',
            ],
            [
                'id' => 19,
                'name' => 'contests.edit',
                'group' => 'contests',
            ],
            [
                'id' => 20,
                'name' => 'contests.delete',
                'group' => 'contests',
            ],
            [
                'id' => 21,
                'name' => 'contestents.view',
                'group' => 'contestents',
            ],
            [
                'id' => 22,
                'name' => 'contestents.create',
                'group' => 'contestents',
            ],
            [
                'id' => 23,
                'name' => 'contestents.edit',
                'group' => 'contestents',
            ],
            [
                'id' => 24,
                'name' => 'contestents.update',
                'group' => 'contestents',
            ],
            [
                'id' => 25,
                'name' => 'contestents.delete',
                'group' => 'contestents',
            ],
            [
                'id' => 26,
                'name' => 'paryavaran-spardha.view',
                'group' => 'paryavaran-spardha',
            ],
            [
                'id' => 27,
                'name' => 'janjagruti-spardha.view',
                'group' => 'janjagruti-spardha',
            ],
            [
                'id' => 28,
                'name' => 'dept-wise-forms.view',
                'group' => 'field-accessor',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'id' => $permission['id']
            ], [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'group' => $permission['group']
            ]);
        }
    }
}
