<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 40);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone'); // simpan sebagai string untuk leading 0
            $table->enum('role', ['user','admin'])->default('user');
            $table->string('admin_id')->nullable(); // untuk admin (ID Admin jika admin)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
