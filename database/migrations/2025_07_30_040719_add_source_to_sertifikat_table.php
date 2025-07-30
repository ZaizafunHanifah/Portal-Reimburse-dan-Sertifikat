<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSourceToSertifikatTable extends Migration
{
    public function up()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->string('source')->default('reimburse')->after('id');
        });
    }

    public function down()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
}