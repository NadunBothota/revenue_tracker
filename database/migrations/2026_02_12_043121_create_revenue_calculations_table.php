<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revenue_sheet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('content_id')->constrained()->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained()->cascadeOnDelete();

            $table->decimal('gross_net_revenue', 12, 2);
            $table->decimal('agreement_percentage', 5, 2);
            $table->decimal('owner_split_percentage', 5, 2);

            $table->decimal('owner_amount', 12, 2);
            $table->decimal('company_amonut', 12, 2);
            $table->timestamps();

            $table->index(['revenue_sheet_id', 'content_id', 'owner_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_calculations');
    }
};
