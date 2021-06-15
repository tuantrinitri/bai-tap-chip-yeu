<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic')->nullable();
            $table->string('title')->nullable();
            $table->string('sender_name');
            $table->string('sender_phone')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('sender_address')->nullable();
            $table->string('sender_ip')->nullable();
            $table->text('sender_content');
            $table->unsignedInteger('reply_by')->nullable();
            $table->timestamp('reply_at')->nullable();
            $table->text('reply_content')->nullable();
            $table->text('reply_attachments')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('contacts');
    }
}
