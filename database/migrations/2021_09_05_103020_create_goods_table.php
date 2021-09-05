<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('code');
            $table->string('weight');
            $table->string('quantity_moscow');
            $table->string('quantity_speterburg');
            $table->string('quantity_samara');
            $table->string('quantity_chelyabinsk');
            $table->string('price_moscow');
            $table->string('price_speterburg');
            $table->string('price_samara');
            $table->string('price_chelyabinsk');
            $table->string('usage');
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
        Schema::dropIfExists('goods');
    }
}
