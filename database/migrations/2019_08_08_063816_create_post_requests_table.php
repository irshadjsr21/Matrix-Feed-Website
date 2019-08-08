<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('body');
            $table->string('image');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->string('status')->default('process');
            $table->string('review')->nullable();
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
        Schema::dropIfExists('post_requests');
    }
}
