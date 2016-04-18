<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $faker = \Faker\Factory::create('vi_VN');

            $subject = new Subject();
            $subject->name = "Subject #" . str_pad($i, 3, '0', STR_PAD_LEFT);
            $subject->description = $faker->text(150);
            $subject->status = $faker->randomElement([Subject::SUBJECT_START, Subject::SUBJECT_TRAINING, Subject::SUBJECT_FINISH]);
            $subject->save();
        }
    }
}
