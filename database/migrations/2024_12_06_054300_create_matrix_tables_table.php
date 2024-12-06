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
        Schema::create('matrix_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_product')->constrained('matrix_products');
            $table->decimal('sum', 10, 2)->default(0);
            $table->decimal('percent', 5, 2)->default(50);
            $table->foreignId('user1')->nullable()->constrained('users');
            $table->foreignId('user2')->nullable()->constrained('users');
            $table->foreignId('user3')->nullable()->constrained('users');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrix_tables');
    }
};
