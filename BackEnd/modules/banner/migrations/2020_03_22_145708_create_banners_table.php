<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('file_src')->nullable();
            $table->string('file_alt')->nullable();
            $table->timestamp('begin_time')->nullable();
            $table->timestamp('expired_time')->nullable();
            $table->string('link')->nullable()->default('#');
            $table->unsignedInteger('order')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::create('banner_widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->unsignedInteger('banner_id')->nullable();
            $table->string('position')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });


        // DB::table('banner_widgets')->insert([
        //     [
        //         'title' => 'Slider trang chủ',
        //         'position' => 'TOP'
        //     ],
        //     [
        //         'title' => 'Banner thành viên FIP',
        //         'position' => 'MIDDLE'
        //     ],
        //     [
        //         'title' => 'Banner đối tác FIP',
        //         'position' => 'BOTTOM'
        //     ]
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('banner_widgets');
    }
}