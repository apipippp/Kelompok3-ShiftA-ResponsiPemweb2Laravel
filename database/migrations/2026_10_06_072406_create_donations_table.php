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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tracking_code')->unique();
            $table->string('donor_name');
            $table->string('donor_phone');
            $table->string('clothing_type');
            $table->integer('quantity');
            $table->enum('condition', ['sangat_baik', 'layak_pakai']);
            $table->string('photo')->nullable();
            $table->enum('delivery_method', ['antar_posko', 'ekspedisi']);
            $table->enum('status', ['menunggu', 'diverifikasi', 'diterima', 'disalurkan', 'dibatalkan'])->default('menunggu');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
