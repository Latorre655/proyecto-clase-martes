<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Guardar datos existentes
        $items = DB::table('cart_items')->get();

        // Recrear tabla sin foreign key
        Schema::drop('cart_items');
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        // Restaurar datos
        foreach ($items as $item) {
            DB::table('cart_items')->insert((array) $item);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};