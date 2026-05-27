<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->string('number', 10)->after('id')->comment('Nomor meja, contoh: "01", "02"');
            $table->integer('capacity')->after('number')->default(4)->comment('Kapasitas jumlah orang');
            $table->enum('status', ['available', 'occupied'])->default('available')->after('capacity')->comment('Status meja: available/occupied');
        });
    }

    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropColumn(['number', 'capacity', 'status']);
        });
    }
};