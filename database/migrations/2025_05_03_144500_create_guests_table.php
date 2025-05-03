<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('guests')) {
            Schema::create('guests', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->enum('status', ['pending', 'confirmed', 'declined'])->default('pending');
                $table->text('dietary_preferences')->nullable();
                $table->text('special_requests')->nullable();
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('event_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamps();

                // Add foreign key constraints
                $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('guests');
    }
};