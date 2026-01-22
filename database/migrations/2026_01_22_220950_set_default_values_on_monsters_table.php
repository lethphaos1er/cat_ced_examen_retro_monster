<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('monsters', function (Blueprint $table) {

            // valeurs neutres
            if (Schema::hasColumn('monsters', 'user_id')) {
                $table->unsignedBigInteger('user_id')->default(1)->change();
            }

            if (Schema::hasColumn('monsters', 'type_id')) {
                $table->unsignedBigInteger('type_id')->default(1)->change();
            }

            if (Schema::hasColumn('monsters', 'rarity')) {
                $table->string('rarity')->default('Commun')->change();
            }

            if (Schema::hasColumn('monsters', 'rarety_id')) {
                $table->unsignedBigInteger('rarety_id')->default(1)->change();
            }

            if (Schema::hasColumn('monsters', 'image_url')) {
                $table->string('image_url')->nullable()->change();
            }
        });
    }

    public function down(): void {}
};
