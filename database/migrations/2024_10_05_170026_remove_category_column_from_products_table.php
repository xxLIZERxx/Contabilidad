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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category'); // Eliminar columna 'category'
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable(); // Volver a agregar la columna 'category' si es necesario
        });
    }
    
};
