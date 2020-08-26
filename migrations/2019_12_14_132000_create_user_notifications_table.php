<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id', false, true);
            $table->bigInteger('author_id', false, true);
            $table->string('title');
            $table->string('message');
            $table->smallInteger('status', false, true)->default(1);
            $table->integer('flags')->default(0);
	        $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();

	        $table->foreign('user_id')->references('id')->on('users');
	        $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
}
