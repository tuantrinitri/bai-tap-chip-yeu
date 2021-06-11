<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255);
            $table->string('image')->nullable();
            $table->string('source')->nullable();
            $table->string('author')->nullable();
            $table->unsignedTinyInteger('featured')->default(0);
            $table->unsignedInteger('created_by');
            $table->timestamp('public_at')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('totalhits')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('category_id');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('content');
            $table->unsignedInteger('post_id');
            $table->string('locale', 5)->default('vi');
            $table->text('description')->nullable();
            $table->unique(['post_id', 'locale']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('post_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order')->default(0);
            $table->string('slug', 255);
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('featured')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('post_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale', 5)->default('vi');
            $table->string('title', 255);
            $table->unsignedInteger('category_id');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('post_translations');
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('post_category_translations');
    }
}
