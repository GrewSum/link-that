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
        Schema::create('link_tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('link_id');
            $table->bigInteger('tag_id');
            $table->timestamps();

            $table
                ->foreign('link_id')
                ->references('id')
                ->on('links')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table
                ->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_tags');
    }
};
