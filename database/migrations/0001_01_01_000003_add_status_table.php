<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tables = ['conges', 'absences', 'retards'];

        foreach ($tables as $tableName) {
            if (!Schema::hasColumn($tableName, 'status')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->enum('status', ['en_attente', 'en_cours', 'refuse'])->default('en_attente');
                });
            }
        }
    }

    public function down()
    {
        $tables = ['conges', 'absences', 'retards'];

        foreach ($tables as $tableName) {
            if (Schema::hasColumn($tableName, 'status')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('status');
                });
            }
        }
    }
};
