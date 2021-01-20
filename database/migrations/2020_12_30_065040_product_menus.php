<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class ProductMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_menus', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('image');
            $table->string('description');
            $table->string('titlefiture1');
            $table->string('fiture1');
            $table->string('titlefiture2')->nullable();
            $table->string('fiture2')->nullable();
            $table->string('titlefiture3')->nullable();
            $table->string('fiture3')->nullable();
            $table->string('titlefiture4')->nullable();
            $table->string('fiture4')->nullable();
            $table->string('titlefiture5')->nullable();
            $table->string('fiture5')->nullable();
            $table->string('titlefiture6')->nullable();
            $table->string('fiture6')->nullable();
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
        //
    }
}
