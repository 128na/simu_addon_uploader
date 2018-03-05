<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('addon_id');
            $table->unsignedBigInteger('count')->default(0)->comment('DL数');
            $table->timestamps();

            $table->index(['addon_id']);
            $table->foreign('addon_id')->references('id')->on('addons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counters', function (Blueprint $table) {
            $table->dropForeign(['addon_id']);
            $table->dropIndex(['addon_id']);
        });
        Schema::dropIfExists('counters');
    }
}
