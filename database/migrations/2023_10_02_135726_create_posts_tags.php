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
        Schema::create('posts_tags', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts', 'id');
            $table->foreignId('tag_id')->constrained('tags', 'id');
            $table->primary(['post_id',
            'tag_id'],'posts_tags_primary');
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
        Schema::dropIfExists('table_articals_tags');
    }
};
