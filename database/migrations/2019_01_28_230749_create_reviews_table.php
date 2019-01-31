<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('reviewable');
            $table->integer('rating');
            $table->text('comment');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }
}
