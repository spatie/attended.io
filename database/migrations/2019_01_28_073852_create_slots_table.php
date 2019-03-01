<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotsTable extends Migration
{
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('track_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('short_slug');
            $table->text('description')->nullable();
            $table->string('type');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->integer('number_of_reviews')->default(0);
            $table->integer('average_review_rating')->default(0);

            $table->timestamps();
        });
    }
}
