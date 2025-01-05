<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Department;
use App\Models\Shift;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MastersSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seed category
        $categories = DB::table('category_master')->orderBy('category_id')->get();
        foreach ($categories as $cat) {
            Category::updateOrCreate([
                'id' => $cat->category_id
            ], [
                'id' => $cat->category_id,
                'name' => $cat->category_name,
            ]);
        }


        //Seed Department
        $departments = DB::table('dept_master')->orderBy('dept_id')->get();
        foreach ($departments as $dep) {
            Department::updateOrCreate([
                'id' => $dep->dept_id
            ], [
                'id' => $dep->dept_id,
                'name' => $dep->dept_name,
            ]);
        }
        Department::create([
            'name'=> 'जनजागृती'
        ]);



        //Seed Ward
        $wards = [
            [
                'id' => 1,
                'name' => 'लोकमान्य - सावरकर नगर प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 2,
                'name' => 'वर्तक नगर प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 3,
                'name' => 'नौपाडा कोपरी प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 4,
                'name' => 'वागळे प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 5,
                'name' => 'माजिवडा - मानपाडा प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 6,
                'name' => 'उथळसर प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 7,
                'name' => 'कळवा प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 8,
                'name' => 'मुंब्रा प्रभाग समिती ',
                'initial' => '1',
            ],
            [
                'id' => 9,
                'name' => 'दिवा प्रभाग समिती ',
                'initial' => '1',
            ],
        ];

        foreach ($wards as $ward) {
            Ward::updateOrCreate([
                'id' => $ward['id']
            ], [
                'id' => $ward['id'],
                'name' => $ward['name'],
                'initial' => $ward['initial']
            ]);
        }


    }
}
