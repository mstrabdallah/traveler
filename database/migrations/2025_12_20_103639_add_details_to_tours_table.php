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
        Schema::table('tours', function (Blueprint $table) {
            $table->string('pickup_location')->nullable()->after('duration_nights');
            $table->string('tour_type')->nullable()->after('pickup_location');
            $table->string('availability')->nullable()->after('tour_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['pickup_location', 'tour_type', 'availability']);
        });
    }
};
