<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnershipsTable extends Migration
{
    public function up()
    {
        Schema::create('ownerships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->morphs('ownable');
        });
    }
}
