<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('users');
            $table->bigInteger('grade_id')->unsigned()->nullable();
            $table->foreign('grade_id')->references('id')->on('drop_downs');
            $table->char('section_name')->nullable();
            $table->bigInteger('school_id')->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('drop_downs');
            $table->enum('gender',['Male','Female'])->default('Male');
            $table->string('name')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('image')->nullable();
            $table->text('child_like')->nullable();
            $table->text('child_dislike')->nullable();
            $table->text('health_warnings')->nullable();
            $table->text('additional_notes')->nullable();
            $table->json('more_details')->nullable();
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
        Schema::dropIfExists('children');
    }
}
