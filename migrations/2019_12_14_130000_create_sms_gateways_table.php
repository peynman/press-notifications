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
            $table->string('gateway');
	        $table->integer('flags', false, true)->default(0);
	        $table->json('data')->nullable();
	        $table->timestamps();
            $table->softDeletes();

            $table->index([
                'deleted_at',
                'created_at',
                'updated_at',
                'name',
                'gateway',
                'flags',
            ], 'sms_gateways_full_index');

            $table->unique(['deleted_at', 'name']);
            $table->foreign('author_id')->references('id')->on('users');
        });
        Schema::create('sms_gateway_domain', function (Blueprint $table) {
	        $table->bigInteger('domain_id', false, true);
            $table->bigInteger('sms_gateway_id', false, true);

            $table->index(['domain_id', 'sms_gateway_id']);

            $table->foreign('domain_id')->references('id')->on('domains');
            $table->foreign('sms_gateway_id')->references('id')->on('sms_gateways');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_gateway_domain');
        Schema::dropIfExists('sms_gateways');
    }
}
