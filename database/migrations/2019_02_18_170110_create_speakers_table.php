<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakersTable extends Migration
{
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('slot_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }
}
