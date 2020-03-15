<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_in_usages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('check_in_id');
            $table
                ->unsignedBigInteger('check_in_category_id')
                ->commnet('チェックインカテゴリ');
            $table->timestamps();

            $table
                ->foreign('check_in_id')
                ->references('id')
                ->on('check_ins')
                ->onDelete('cascade');
            $table
                ->foreign('check_in_category_id')
                ->references('id')
                ->on('check_in_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_in_usages');
    }
}
