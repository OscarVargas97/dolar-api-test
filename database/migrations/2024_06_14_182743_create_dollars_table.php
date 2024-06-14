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
        Schema::create('dollars', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->timestamps();
        });

        Schema::create('dollars_values', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 8, 2);
            $table->foreignId('dollar_id')->constrained()->cascadeOnDelete()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dollars');
        Schema::dropIfExists('dollars_values');
    }
};
