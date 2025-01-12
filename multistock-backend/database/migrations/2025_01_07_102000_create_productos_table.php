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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('sku')->unique();
            $table->foreignId('tipo')->constrained('tipo_productos')->onDelete('cascade');
            $table->foreignId('marca')->constrained('marcas')->onDelete('cascade');
            $table->boolean('control_stock');
            $table->decimal('precio', 10, 2);
            $table->boolean('permitir_venta_no_stock');
            $table->string('nombre_variante')->nullable();
            $table->boolean('control_series');
            $table->boolean('permitir_venta_decimales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
