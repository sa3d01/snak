<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable();
            $table->json('note')->nullable();
            $table->json('images')->nullable();
            $table->integer('price')->nullable();
            $table->string('color')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('period')->default(30);
            $table->integer('user_promo_code')->default(0);
            $table->boolean('show_images')->default(0);
            $table->boolean('delivery')->default(0);
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
        Schema::dropIfExists('packages');
    }
}
