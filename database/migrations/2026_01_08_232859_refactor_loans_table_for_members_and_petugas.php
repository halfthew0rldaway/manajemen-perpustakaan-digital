<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Drop old user_id foreign key and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Add new foreign keys
            $table->foreignId('member_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('petugas_id')->after('member_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Drop new foreign keys
            $table->dropForeign(['member_id']);
            $table->dropForeign(['petugas_id']);
            $table->dropColumn(['member_id', 'petugas_id']);

            // Restore old user_id
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        });
    }
};
