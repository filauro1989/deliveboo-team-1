<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            // CHIAVE ESTERNA
            $table->foreign('user_id')
                // DELLA COLONNA ID
                ->references('id')
                // DELLA TABELLA USERS
                ->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('course_id')->nullable();
            // CHIAVE ESTERNA
            $table->foreign('course_id')
                // DELLA COLONNA ID
                ->references('id')
                // DELLA TABELLA COURSES
                ->on('courses');

            $table->string('name');
            $table->string('description');
            $table->float('price', 6, 2);
            $table->string('image')->nullable();
            $table->boolean('visible');
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
        Schema::dropIfExists('dishes');
    }
}
