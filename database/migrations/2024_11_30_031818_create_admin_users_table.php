<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password_hash');
            $table->enum('role', ['admin', 'superadmin']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
};