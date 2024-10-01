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
        Schema::table('phone_compatibilities', function (Blueprint $table) {
            $table->foreignId('phone_id_1')->constrained('phones')->onDelete('cascade');
            $table->foreignId('phone_id_2')->constrained('phones')->onDelete('cascade');
            $table->boolean('verified')->default(false);
            $table->boolean('possible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phone_compatibilities', function (Blueprint $table) {
            $table->dropConstrainedForeignId("phone_id_1");
            $table->dropConstrainedForeignId("phone_id_2");
            $table->dropColumn("verified");
            $table->dropColumn("possible");
        });
    }
};
