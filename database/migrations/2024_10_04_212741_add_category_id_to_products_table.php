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
            $table->unsignedBigInteger('category_id')->after('name'); // Agregar columna 'category_id'
            
            // Agregar la clave foránea para la relación con la tabla 'categories'
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Eliminar clave foránea
            $table->dropColumn('category_id'); // Eliminar columna 'category_id'
        });
    }
    
};
