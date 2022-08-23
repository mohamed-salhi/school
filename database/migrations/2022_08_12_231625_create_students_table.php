<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('Gender');
            $table->foreignId('nationalitie_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('blood_id')->onUpdate('cascade')->onDelete('cascade');
            $table->date('Date_Birth');
            $table->foreignId('Grade_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Classroom_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('section_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('parent_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('academic_year');
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
        Schema::dropIfExists('students');
    }
}
