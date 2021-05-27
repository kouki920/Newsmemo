<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('year');
            $table->unsignedInteger('month');
            $table->unsignedInteger('day');
            $table->unsignedInteger('hour');
            $table->unsignedInteger('minute');
            $table->unsignedInteger('second');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['year', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logins');
    }
}
