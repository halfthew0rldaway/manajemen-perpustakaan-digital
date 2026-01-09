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
        Schema::table('members', function (Blueprint $table) {
            // Rename nim_nis to member_id_number (more general for public library)
            $table->renameColumn('nim_nis', 'member_id_number');

            // Rename program_studi_kelas to occupation_institution
            $table->renameColumn('program_studi_kelas', 'occupation_institution');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Revert the column names
            $table->renameColumn('member_id_number', 'nim_nis');
            $table->renameColumn('occupation_institution', 'program_studi_kelas');
        });
    }
};
