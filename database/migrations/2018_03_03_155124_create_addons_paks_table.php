<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonsPaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon_pak', function (Blueprint $table) {
            $table->unsignedBigInteger('addon_id');
            $table->unsignedBigInteger('pak_id');

            $table->index(['addon_id']);
            $table->index(['pak_id']);
            $table->foreign('addon_id')->references('id')->on('addons')->onDelete('cascade');
            $table->foreign('pak_id')->references('id')->on('paks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addon_pak', function (Blueprint $table) {
            $table->dropForeign(['addon_id']);
            $table->dropForeign(['pak_id']);
            $table->dropIndex(['addon_id']);
            $table->dropIndex(['pak_id']);
        });
        Schema::dropIfExists('addon_pak');
    }
}
