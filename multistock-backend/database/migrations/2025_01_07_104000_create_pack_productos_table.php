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
        Schema::create('pack_productos', function (Blueprint $table) {
            $table->id();
            $table->string('sku_pack')->unique()->nullable(); // Permitir valores nulos inicialmente
            $table->string('nombre');
            $table->timestamps();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pack_productos');
    }
};
