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
            // Agregar una columna 'role' de tipo ENUM con los roles disponibles
            $table->enum('role', ['admin', 'contador', 'auditor', 'cliente'])->default('cliente')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la columna 'role' en caso de revertir la migración
            $table->dropColumn('role');
        });
    }
};
