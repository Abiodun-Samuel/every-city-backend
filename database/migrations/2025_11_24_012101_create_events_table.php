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

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('location')->nullable();

            $table->string('image')->nullable();

            $table->integer('max_tickets')->default(0);

            $table->date('date')->nullable();
            $table->time('time')->nullable();

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
