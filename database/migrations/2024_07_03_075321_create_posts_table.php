<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 80);
            $table->text('content');
            $table->foreignId('category_id');
            $table->foreignId('topic_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
