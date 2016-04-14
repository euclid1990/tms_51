<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
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

            $course = new Course();
            $course->name = "TRAINING #" . str_pad($i, 3, '0', STR_PAD_LEFT);
            $course->description = $faker->text(200);
            $course->status = $faker->randomElement([Course::COURSE_START, Course::COURSE_TRAINING, Course::COURSE_FINISH]);
            $course->save();
        }
    }
}
