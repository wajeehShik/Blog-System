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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->longText('description')->index(); //وصف مختصر عشان ينعرض في عرض منتج
            $table->longText('content')->index(); //وصف كامل
            $table->unsignedTinyInteger('status')->default(0);
            $table->string("image");
            $table->unsignedTinyInteger('comment_able')->default(1);
            $table->foreignId('admin_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
