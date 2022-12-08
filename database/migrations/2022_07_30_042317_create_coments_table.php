<?php

use App\Models\Post;
use App\Models\User;
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
        Schema::create('coments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('coment');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Post::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coments');
    }
};
