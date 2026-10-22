
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('motors', 'gambar')) {
            Schema::table('motors', function (Blueprint $table) {
                $table->string('gambar')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Tidak menghapus kolom agar data tetap aman.
    }
};
