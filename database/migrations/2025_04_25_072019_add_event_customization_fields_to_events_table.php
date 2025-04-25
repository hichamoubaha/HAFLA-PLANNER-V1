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
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // Event Type and Category
            $table->string('event_type')->nullable();
            $table->string('category')->nullable();
            
            // Customization Options
            $table->json('theme_colors')->nullable();
            $table->string('logo_path')->nullable();
            $table->text('custom_message')->nullable();
            
            // Media
            $table->json('media_gallery')->nullable();
            
            // Budget Information
            $table->decimal('budget', 10, 2)->nullable();
            $table->json('budget_breakdown')->nullable();
            
            // Additional Details
            $table->integer('max_participants')->nullable();
            $table->json('amenities')->nullable();
            $table->text('special_requirements')->nullable();
            
            // Contact Information
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            
            // Status
            $table->string('status')->default('draft');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'event_type',
                'category',
                'theme_colors',
                'logo_path',
                'custom_message',
                'media_gallery',
                'budget',
                'budget_breakdown',
                'max_participants',
                'amenities',
                'special_requirements',
                'contact_email',
                'contact_phone',
                'status'
            ]);
        });
    }
};
