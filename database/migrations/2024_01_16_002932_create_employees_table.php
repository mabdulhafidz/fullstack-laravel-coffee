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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('nip');
            $table->integer('nik');
            $table->string('nama');
            $table->enum('jenis kelamin', ['pria','wanita']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('telpon');
            $table->string('agama');
            $table->enum('status nikah', ['belum nikah', 'nikah']);
            $table->text('alamat');
            $table->string('image');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
