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
            $table->string('name_ar')->nullable()->after('name');
            $table->longText('description_ar')->nullable()->after('description');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->longText('content_ar')->nullable()->after('content');
            $table->text('excerpt_ar')->nullable()->after('excerpt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'description_ar']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'content_ar', 'excerpt_ar']);
        });
    }
};
