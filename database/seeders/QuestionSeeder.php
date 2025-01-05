<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Question seeder
        $questions = DB::table('activity_master')->orderBy('activity_id')->get();
        foreach ($questions as $q) {
            Question::updateOrCreate([
                'id' => $q->activity_id
            ], [
                'id' => $q->activity_id,
                'user_id'=> '2',
                'category_id' => $q->category_id,
                'competition_type_id' => $q->competition_type,
                'department_id' => $q->dept_id,
                'name' => $q->activity_name,
                'marks' => $q->marks,
            ]);
        }


        // Option seeder
        $options = DB::table('class_master')->orderBy('class_id')->get();
        foreach ($options as $op) {
            Option::updateOrCreate([
                'id' => $op->class_id
            ], [
                'id' => $op->class_id,
                'question_id' => $op->activity_id,
                'name' => $op->class_name,
                'marks' => $op->marks,
            ]);
        }
    }
}
