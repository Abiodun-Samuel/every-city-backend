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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // contact, prayer, bhop_application, mail_list
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->text('address')->nullable();
            $table->string('type_of_prayer')->nullable();
            $table->text('prayer_request')->nullable();
            $table->string('location')->nullable();
            $table->string('church')->nullable();
            $table->string('team_volunteering_to')->nullable();
            $table->boolean('want_to_be_part_of_team')->nullable();
            $table->text('reason')->nullable();
            $table->text('content')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->index('type');
            $table->index('email');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
