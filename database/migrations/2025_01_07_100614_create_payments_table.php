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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Client name
            $table->string('city'); // Client city
            $table->string('phone'); // Client phone number
            $table->decimal('due_payment', 10, 2)->default(0); // Due payment amount
            $table->date('date'); // Payment date
            $table->decimal('received_payment', 10, 2); // Payment received
            $table->decimal('payed', 10, 2)->default(0); 
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
