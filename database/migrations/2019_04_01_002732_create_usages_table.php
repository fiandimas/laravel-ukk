<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_customer')->unsigned()->index();
            $table->foreign('id_customer')->on('customer')->references('id');
            $table->string('month',20);
            $table->year('year',20);
            $table->float('start_meter');
            $table->float('finish_meter');
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
        Schema::dropIfExists('usage');
    }
}
