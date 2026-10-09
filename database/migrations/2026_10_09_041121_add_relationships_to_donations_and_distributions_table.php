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
        Schema::table('donations', function (Blueprint $table) {
            $table->foreignId('drop_point_id')->nullable()->after('user_id')->constrained('drop_points')->nullOnDelete();
        });

        Schema::table('distributions', function (Blueprint $table) {
            $table->foreignId('donation_id')->nullable()->unique()->after('id')->constrained('donations')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['drop_point_id']);
            $table->dropColumn('drop_point_id');
        });

        Schema::table('distributions', function (Blueprint $table) {
            $table->dropForeign(['donation_id']);
            $table->dropColumn('donation_id');
        });
    }
};
