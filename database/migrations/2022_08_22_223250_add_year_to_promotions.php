<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYearToPromotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->foreignId('from_year_id')->onUpdate('cascade')->onDelete('cascade');;;
            $table->foreignId('to_year_id')->onUpdate('cascade')->onDelete('cascade');;;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotions', function (Blueprint $table) {
          $table->dropColumn('from_year_id');
            $table->dropColumn('to_year_id');

        });
    }
}
