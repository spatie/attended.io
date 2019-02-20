<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->text('location');
            $table->string('city');
            $table->string('country_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_emoji')->nullable();

            $table->string('website');

            $table->boolean('cfp')->default(false);
            $table->string('cfp_link')->nullable();
            $table->dateTime('cfp_deadline')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->integer('number_of_reviews')->default(0);
            $table->integer('average_review_rating')->default(0);

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }
}
