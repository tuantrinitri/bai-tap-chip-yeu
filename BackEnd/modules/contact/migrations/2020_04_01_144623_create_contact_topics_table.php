<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedTinyInteger('status');
            $table->longText('note')->nullable();
            $table->string('mail_title')->nullable();
            $table->longText('mail_content')->nullable();
            $table->unsignedTinyInteger('mail_status')->nullable();
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
        Schema::dropIfExists('contact_topics');
    }
}
