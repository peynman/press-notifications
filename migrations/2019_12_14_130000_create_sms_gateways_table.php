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

            $table->index(['deleted_at', 'created_at', 'updated_at']);
            $table->unique(['deleted_at', 'created_at', 'updated_at']);

            $table->foreign('author_id')->references('id')->on('users');
        });
        Schema::create('sms_gateways_domains', function (Blueprint $table) {
	        $table->bigInteger('domain_id', false, true);
            $table->bigInteger('sms_gateway_id', false, true);

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
        Schema::dropIfExists('sms_gateways_domains');
        Schema::dropIfExists('sms_gateways');
    }
}
