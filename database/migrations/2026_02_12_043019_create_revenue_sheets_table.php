<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operator_id')->constrained()->cascadeOnDelete();
            $table->string('period_month');
            $table->string('file_path');
            $table->enum('status', ['draft', 'calculated', 'posted'])->default('draft');
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->index(['operator_id', 'period_month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_sheets');
    }
};
