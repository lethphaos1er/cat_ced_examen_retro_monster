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
        Schema::create('monsters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('user_id')->nullable();
            $table->integer('type_id')->nullable()->index('type_id');
            $table->string('rarity', 255);
            $table->integer('pv');
            $table->integer('attack');
            $table->string('image_url', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->integer('defense')->default(0);
            $table->unsignedInteger('rarety_id')->nullable()->default(1)->index('fk_rarety_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monsters');
    }
};
