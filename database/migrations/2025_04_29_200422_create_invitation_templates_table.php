<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('invitation_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // wedding, birthday, conference, etc.
            $table->text('description')->nullable();
            $table->string('thumbnail_path');
            $table->json('default_colors')->nullable(); // Store default color scheme
            $table->json('layout_config')->nullable(); // Store layout configuration
            $table->json('customizable_fields')->nullable(); // Store which fields can be customized
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitation_templates');
    }
};
