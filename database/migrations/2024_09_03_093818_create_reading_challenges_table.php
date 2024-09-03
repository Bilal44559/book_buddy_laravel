<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingChallengesTable extends Migration
{
    public function up()
    {
        Schema::create('reading_challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon')->nullable();
            $table->text('description');
            $table->string('time_frame');
            $table->timestamps();
        });

        // Create a pivot table to link challenges to books
        Schema::create('challenge_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reading_challenge_id')->constrained()->onDelete('cascade');  // Foreign key to challenges
            $table->foreignId('book_id')->constrained()->onDelete('cascade');  // Foreign key to books
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenge_book');
        Schema::dropIfExists('reading_challenges');
    }
}
