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
        Schema::create('revenue_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revenue_sheet_id')->constrained()->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->string('song_id')->nullable();
            $table->string('content_title')->nullable();
            $table->string('artist_name')->nullable();
            $table->decimal('net_revenue', 12, 2)->default(0);
            $table->timestamps();

            $table->index(['song_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_rows');
    }
};
