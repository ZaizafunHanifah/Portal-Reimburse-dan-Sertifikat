<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->string('status_progres_reimburse')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->string('status_progres_reimburse')->nullable(false)->change();
        });
    }

};
