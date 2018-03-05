<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title', 255)->comment('タイトル');
            $table->string('name', 255)->comment('ファイル名');
            $table->string('path', 255)->comment('ファイルパス');
            $table->longText('description')->nullable()->comment('説明');
            $table->json('info')->comment('パースしたファイルデータ');
            $table->integer('status')->comment('公開状態');
            $table->timestamps();

            $table->index(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addons', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
        });

        Schema::dropIfExists('addons');
    }
}
