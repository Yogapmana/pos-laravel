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
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('payment_method', 50)->comment('Tunai, Midtrans, dll');
            $table->integer('amount_received')->comment('Jumlah uang yang diterima');
            $table->integer('change')->default(0)->comment('Kembalian');
            $table->integer('subtotal')->comment('Subtotal sebelum PPN');
            $table->integer('tax')->comment('PPN 11%');
            $table->integer('total')->comment('Total akhir');
            $table->string('midtrans_order_id')->nullable()->comment('Order ID dari Midtrans');
            $table->string('midtrans_payment_type')->nullable()->comment('Jenis payment Midtrans');
            $table->string('status', 20)->default('completed')->comment('pending, completed, failed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};