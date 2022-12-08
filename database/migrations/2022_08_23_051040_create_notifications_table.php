<?php

use App\Models\Post;
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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreignId('send_by')->references('id')->on('users');
            $table->foreignId('send_to')->references('id')->on('users');
            $table->string('body');
            $table->enum('status', ['un_read', 'read']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
