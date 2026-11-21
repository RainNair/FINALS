<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_number', 50)->unique();
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->decimal('amount', 12, 2);
            $table->date('transaction_date');
            $table->time('reservation_time');
            $table->unsignedInteger('guest_count')->default(1);
            $table->string('table_type')->default('Standard table');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
