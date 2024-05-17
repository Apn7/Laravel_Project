<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportedMemesTable extends Migration
{
    public function up()
    {
        Schema::create('reported_memes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meme_id')->constrained('memes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('reason');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reported_memes');
    }
}
