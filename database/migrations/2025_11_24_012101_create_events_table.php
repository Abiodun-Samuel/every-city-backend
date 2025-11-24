<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // core event info
            $table->string('title');
            $table->longText('description')->nullable();

            // organizer info (From EveryCity: first name, last name, email, phone)
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');

            // tickets
            $table->integer('max_tickets')->default(0);

            // event timing
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');

            // status (current / past / upcoming)
            $table->enum('status', ['current', 'upcoming', 'past'])->default('upcoming');

            // EveryCity category (Flow, BHOP, MKC, etc.)
            $table->string('event_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
