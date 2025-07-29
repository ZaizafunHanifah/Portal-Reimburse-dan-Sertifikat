<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sertifikat_non_psos', function (Blueprint $table) {
            $table->string('pelabuhan')->nullable()->after('tipe');
        });
    }

    public function down(): void
    {
        Schema::table('sertifikat_non_psos', function (Blueprint $table) {
            $table->dropColumn('pelabuhan');
        });
    }
};