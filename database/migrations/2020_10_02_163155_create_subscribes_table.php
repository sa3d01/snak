<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->nullable();
            $table->foreignId('package_id')->nullable();
            $table->foreignId('break_id')->nullable();
            $table->foreignId('promo_code_id')->nullable();
            $table->json('days')->nullable();
            $table->enum('status',['pending','approved','rejected'])->default('pending');
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
        Schema::dropIfExists('subscribes');
    }
}
