
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reimburses', function (Blueprint $table) {
            $table->date('on_review_date')->nullable()->after('tanggal_pengajuan');
            $table->date('lnd_date')->nullable()->after('on_review_date');
            $table->date('akuntansi_date')->nullable()->after('lnd_date');
            $table->date('treasury_date')->nullable()->after('akuntansi_date');
            $table->date('cleared_date')->nullable()->after('treasury_date');
        });
    }

    public function down(): void
    {
        Schema::table('reimbursements', function (Blueprint $table) {
            $table->dropColumn([
                'on_review_date',
                'lnd_date',
                'akuntansi_date',
                'treasury_date',
                'cleared_date'
            ]);
        });
    }
};


