<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Rename the table if it exists
        if (Schema::hasTable('sertifikats_nonpso')) {
            Schema::rename('sertifikats_nonpso', 'sertifikat_non_psos');
        }
    }

    public function down(): void
    {
        // Rollback: rename back if needed
        if (Schema::hasTable('sertifikat_non_psos')) {
            Schema::rename('sertifikat_non_psos', 'sertifikats_nonpso');
        }
    }
};