<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Course ID
            $table->string('course_name'); // Course Code
            $table->text('description')->nullable(); // Course Description
            $table->integer('credit_hours'); // Credit Hours / Course Duration
            $table->timestamps(); // Created at & Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
~
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
