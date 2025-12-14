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
        Schema::create('custom_tour_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('request_title')->nullable();
            $table->string('email');
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->string('ages_range')->nullable();
            $table->json('destinations')->nullable();
            $table->string('accommodation')->nullable();
            $table->text('notes')->nullable();
            $table->string('referral_source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_tour_requests');
    }
};
