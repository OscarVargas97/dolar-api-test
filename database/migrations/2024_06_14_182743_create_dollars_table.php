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
        Schema::create('currency_types', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->timestamps();
        });

        Schema::create('currency_aliases', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->unique();
            $table->foreignId('currency_type_id')->constrained('currency_types')->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('dollars_values', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 8, 2);
            $table->foreignId('type_id')->constrained('currency_types')->cascadeOnDelete()->nullable(false);
            $table->timestamps();
        });
        Schema::create('dollars', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->foreignId('value_id')->constrained('dollars_values')->cascadeOnDelete()->nullable(false);
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
