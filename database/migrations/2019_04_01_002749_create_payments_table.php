<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bill')->unsigned()->index();
            $table->foreign('id_bill')->on('bill')->references('id');
            $table->date('date_pay');
            $table->string('month_pay',20);
            $table->integer('cost_admin');
            $table->integer('total_pay');
            $table->string('status',20);
            $table->string('image');
            $table->integer('id_admin')->unsigned()->index();
            $table->foreign('id_admin')->on('admin')->references('id');
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
        Schema::dropIfExists('payments');
    }
}
