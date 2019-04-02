<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name',50);
            $table->string('username',50);
            $table->string('password',100);
            $table->string('kwh_number',50);
            $table->text('address');
            $table->integer('id_cost')->unsigned()->index();
            $table->foreign('id_cost')->on('cost')->references('id');
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
        Schema::dropIfExists('customer');
    }
}
