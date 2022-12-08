<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreignId('send_by')->references('id')->on('users');
            $table->foreignId('send_to')->references('id')->on('users');
            $table->enum('status', ['un_read', 'send', 'read'])->default('un_read');
            $table->text('body');
            $table->integer('deleted_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
