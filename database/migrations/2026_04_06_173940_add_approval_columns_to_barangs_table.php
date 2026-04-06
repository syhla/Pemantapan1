<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->boolean('approved')->default(true); // atau false sesuai kebutuhan
            $table->string('rejected_reason')->nullable(); // alasan reject
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn('approved');
            $table->dropColumn('rejected_reason');
        });
    }
};
