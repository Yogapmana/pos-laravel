<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('table_id')->nullable()->after('id')->constrained('tables')->cascadeOnDelete();
            $table->foreignId('cashier_id')->nullable()->after('table_id')->constrained('users')->cascadeOnDelete();
            $table->string('order_number', 20)->after('cashier_id')->comment('Nomor order unik, contoh: ORD-20260515-001');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['table_id']);
            $table->dropForeign(['cashier_id']);
            $table->dropColumn(['table_id', 'cashier_id', 'order_number']);
        });
    }
};