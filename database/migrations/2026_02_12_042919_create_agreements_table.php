<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('agreement_number')->unique();
            $table->string('subcategory')->nullable();
            $table->enum('payment_term', ['Revenue Share', 'Advance Recovered'])->default('Revenue Share');
            $table->decimal('artisan_revenue_percentage', 5, 2);
            $table->text('remarks')->nullable();
            $table->date('effective_from')->nullable();
            $table->date('effective-to')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
