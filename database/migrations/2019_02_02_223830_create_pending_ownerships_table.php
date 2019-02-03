<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingOwnershipsTable extends Migration
{
    public function up()
    {
        Schema::create('pending_ownerships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->morphs('ownable');
            $table->timestamps();
        });
    }
}
