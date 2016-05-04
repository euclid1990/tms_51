<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUserCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_course', function ($table) {
            //if is supervior then start_date and end_date win be null
            $table->tinyInteger('start_date')->default(null)->change();
            $table->tinyInteger('end_date')->default(null)->change();
            $table->tinyInteger('status')->default(1)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_courses', function ($table) {
            $table->tinyInteger('start_date')->default('0000-00-00')->change();
            $table->tinyInteger('end_date')->default('0000-00-00')->change();
            $table->tinyInteger('status')->default(null)->change();
        });
    }
}
