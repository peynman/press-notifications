<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sms_gateway_id', false, true);
            $table->bigInteger('author_id', false, true)->nullable();
            $table->string('from');
            $table->string('to');
            $table->string('message');
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->smallInteger('status', false, true)->default(1);
            $table->integer('flags')->default(0);
            $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(
                [
                    'deleted_at',
                    'created_at',
                    'updated_at',
                    'sms_gateway_id',
                    'author_id',
                    'status',
                    'from',
                    'to',
                    'flags'
                ],
                'sms_messages_full_index'
            );

            $table->foreign('sms_gateway_id')->references('id')->on('sms_gateways');
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
        Schema::dropIfExists('sms_messages');
    }
}
