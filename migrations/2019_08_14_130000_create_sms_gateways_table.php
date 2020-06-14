<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_gateways', function (Blueprint $table) {
	        $table->bigIncrements('id');
            $table->bigInteger('author_id', false, true)->nullable();
            $table->string('name');
	        $table->integer('flags', false, true)->default(0);
	        $table->json('data')->nullable();
	        $table->timestamps();
            $table->softDeletes();

            $table->unique(['deleted_at', 'name']);

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
        Schema::dropIfExists('sms_gateways');
    }
}
