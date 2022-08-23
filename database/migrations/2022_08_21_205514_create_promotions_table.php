<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignId('from_grade_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignId('from_Classroom_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignId('from_section_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignId('to_grade_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignId('to_Classroom_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignId('to_section_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
