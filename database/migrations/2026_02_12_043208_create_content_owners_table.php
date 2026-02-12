<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained()->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained()->cascadeOnDelete();
            $table->decimal('split_percentage', 5, 2);
            $table->timestamps();
            $table->unique(['content_id', 'owner_id']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('content_owners');
    }
};
