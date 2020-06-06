<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->after('id');
            $table->foreign(['user_id'])
                ->references('id')->on('users')
                ->onDelete('cascade')->nullable();
            $table->renameColumn('text', 'course_title');
            $table->string('course_code', 255)->after('text');
            $table->text('course_description')->after('course_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'course_title' ,'course_code', 'course_description']);
        });
    }
}
