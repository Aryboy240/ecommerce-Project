<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthday')->nullable();
            $table->string('profile_picture')->nullable();
            $table->json('billing_address')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['birthday', 'profile_picture', 'billing_address']);
        });
    }
}; 