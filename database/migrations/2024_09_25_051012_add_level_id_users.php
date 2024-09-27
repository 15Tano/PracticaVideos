<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('level_id')->unsigned()->nullable()
                ->after('id');

            $table->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['level_id']); // Elimina la clave foránea
            $table->dropColumn('level_id');    // Elimina la columna level_id
        });
    }
};
