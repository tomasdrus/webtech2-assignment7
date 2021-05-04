<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views_cities', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('flag');
            $table->string('city');
            $table->double('lat');
            $table->double('lng');
            $table->integer('count')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('views_cities');
    }
}
