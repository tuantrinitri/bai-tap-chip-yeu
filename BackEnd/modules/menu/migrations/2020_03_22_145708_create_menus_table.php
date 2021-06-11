<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->text('link');
            $table->unsignedInteger('order');
            $table->string('module')->nullable();
            $table->string('target')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('menu_item_transtion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('locale')->default('vi');
            $table->text('content')->nullable();
            $table->unsignedInteger('menu_item_id');
            $table->unique(['menu_item_id', 'locale']);
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
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
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menu_item_transtion');
    }
}
