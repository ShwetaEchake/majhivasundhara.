<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultLoginUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tenant = Tenant::updateOrCreate([
            'name'=> 'माझी वसुंधरा',
        ],[
            'name'=> 'माझी वसुंधरा',
            'address'=> 'Thane - 401 107',
        ]);

        // User Seeder ##
        $userRole = Role::updateOrCreate(['name'=> 'User', 'tenant_id'=> '1']);

        $user = User::updateOrCreate([
            'username' => 'aa@gmail.com'
        ],[
            'tenant_id' => $tenant->id,
            'competition_type_id' => '1',
            'username' => 'aa@gmail.com',
            'password' => Hash::make('12345678'),
            'category_id' => '3',
            'society_name' => 'Test Society',
            'society_telephone' => '1234567890',
            'nodal_person_name' => 'Test person',
            'nodal_person_contact' => '9999999991',
            'nodal_person_email' => 'aa@gmail.com',
            'building_name' => 'test building',
            'area_name' => 'test area',
            'city' => 'test city',
            'landmark' => 'test landmark',
            'pincode' => 'test pincode',
            'ward_id' => '1',
        ]);
        DB::table('model_has_roles')->updateOrInsert([
            'model_type'=> 'App\Models\User',
            'model_id'=> $user->id,
        ],[
            'role_id'=> $userRole->id,
            'tenant_id'=> $tenant->id
        ]);



        // Super Admin Seeder ##
        $superAdminRole = Role::updateOrCreate(['name' => 'Super Admin','tenant_id' => 1]);
        $permissions = Permission::pluck('id','id')->all();
        $superAdminRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'username' => 'coreocean@gmail.com'
        ],[
            'tenant_id' => $tenant->id,
            'competition_type_id' => '1',
            'username' => 'coreocean@gmail.com',
            'password' => Hash::make('12345678'),
            'category_id' => '3',
            'society_name' => 'Test Society',
            'society_telephone' => '1234567890',
            'nodal_person_name' => 'Test person',
            'nodal_person_contact' => '9999999991',
            'nodal_person_email' => 'coreocean@gmail.com',
            'building_name' => 'test building',
            'area_name' => 'test area',
            'city' => 'test city',
            'landmark' => 'test landmark',
            'pincode' => 'test pincode',
            'ward_id' => '1',
        ]);
        DB::table('model_has_roles')->updateOrInsert([
            'model_type'=> 'App\Models\User',
            'model_id'=> $user->id,
        ],[
            'role_id'=> $superAdminRole->id,
            'tenant_id'=> $tenant->id
        ]);




        // Admin Seeder ##
        $adminRole = Role::updateOrCreate(['name' => 'Admin','tenant_id' => 1]);
        $permissions = Permission::pluck('id','id')->whereNotIn('id', [1,28])->all();
        $adminRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'username' => 'admin@gmail.com'
        ],[
            'tenant_id' => $tenant->id,
            'competition_type_id' => '1',
            'username' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'category_id' => '3',
            'society_name' => 'Test Society',
            'society_telephone' => '1234567890',
            'nodal_person_name' => 'Test person',
            'nodal_person_contact' => '9999999991',
            'nodal_person_email' => 'admin@gmail.com',
            'building_name' => 'test building',
            'area_name' => 'test area',
            'city' => 'test city',
            'landmark' => 'test landmark',
            'pincode' => 'test pincode',
            'ward_id' => '1',
        ]);
        DB::table('model_has_roles')->updateOrInsert([
            'model_type'=> 'App\Models\User',
            'model_id'=> $user->id,
        ],[
            'role_id'=> $adminRole->id,
            'tenant_id'=> $tenant->id
        ]);



        // Desktop Accessor Seeder ##
        $desktopRole = Role::updateOrCreate(['name' => 'Desktop Accessor','tenant_id' => 1]);
        $permissions = Permission::pluck('id','id')->whereNotIn('id', [1,28])->all();
        $desktopRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'username' => 'desktop@gmail.com'
        ],[
            'tenant_id' => $tenant->id,
            'competition_type_id' => '1',
            'username' => 'desktop@gmail.com',
            'password' => Hash::make('12345678'),
            'category_id' => '3',
            'society_name' => 'Test Society',
            'society_telephone' => '1234567890',
            'nodal_person_name' => 'Test person',
            'nodal_person_contact' => '9999999991',
            'nodal_person_email' => 'desktop@gmail.com',
            'building_name' => 'test building',
            'area_name' => 'test area',
            'city' => 'test city',
            'landmark' => 'test landmark',
            'pincode' => 'test pincode',
            'ward_id' => '1',
        ]);
        DB::table('model_has_roles')->updateOrInsert([
            'model_type'=> 'App\Models\User',
            'model_id'=> $user->id,
        ],[
            'role_id'=> $desktopRole->id,
            'tenant_id'=> $tenant->id
        ]);



        // Field Accessor Seeder ##
        $fieldRole = Role::updateOrCreate(['name' => 'Field Accessor','tenant_id' => 1]);
        $permissions = Permission::where('id', 28)->pluck('id','id');
        $fieldRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'username' => 'field@gmail.com'
        ],[
            'tenant_id' => $tenant->id,
            'competition_type_id' => '1',
            'username' => 'field@gmail.com',
            'password' => Hash::make('12345678'),
            'category_id' => '3',
            'society_name' => 'Test Society',
            'society_telephone' => '1234567890',
            'nodal_person_name' => 'Test person',
            'nodal_person_contact' => '9999999991',
            'nodal_person_email' => 'field@gmail.com',
            'building_name' => 'test building',
            'area_name' => 'test area',
            'city' => 'test city',
            'landmark' => 'test landmark',
            'pincode' => 'test pincode',
            'ward_id' => '1',
        ]);
        DB::table('model_has_roles')->updateOrInsert([
            'model_type'=> 'App\Models\User',
            'model_id'=> $user->id,
        ],[
            'role_id'=> $fieldRole->id,
            'tenant_id'=> $tenant->id
        ]);
    }
}
