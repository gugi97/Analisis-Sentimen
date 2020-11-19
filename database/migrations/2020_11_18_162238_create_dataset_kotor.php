<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetKotor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_kotor', function (Blueprint $table) {
            $table->bigInteger('id_tweet')->primary();
            $table->string('user', 128);
            $table->mediumText('tweet');
            $table->timestamp('date');
            $table->string('category', 128);
            $table->string('datatype', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataset_kotor');
    }
}