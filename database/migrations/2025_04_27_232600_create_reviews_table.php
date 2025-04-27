<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}; 