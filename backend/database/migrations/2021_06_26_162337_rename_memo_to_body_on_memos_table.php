<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMemoToBodyOnMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->renameColumn('memo', 'body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->renameColumn('body', 'memo');
        });
    }
}
