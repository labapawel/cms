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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0); // id rodzica
            $table->string('title'); // tytuł
            $table->longText('content'); // treść
            $table->boolean('active')->default(1); // aktywność
            $table->boolean('is_menu')->default(0); // czy w menu
            $table->integer('position')->default(0); // pozycja w menu
            $table->boolean('new_window')->default(0); // otwieranie w nowym oknie
            $table->string('meta_title')->nullable(); // meta title
            $table->string('meta_description')->nullable(); // meta description
            $table->string('meta_keywords')->nullable(); // meta keywords
            $table->string('slug'); // url
            $table->timestamps(); // daty utworzenia i aktualizacji
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
