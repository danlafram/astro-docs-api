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
        Schema::create('content_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 256);
            $table->string('slug', 512);
            $table->string('search_id');
            $table->string('confluence_id');
            $table->integer('views')->default(0);
            $table->boolean('visible')->default(true);
            $table->date('confluence_created_at');
            $table->date('confluence_updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};
