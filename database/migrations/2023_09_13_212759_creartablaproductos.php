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
        Schema::create('productos',function(Blueprint $table){
            $table->id();
            $table->string('nombre',50);
            $table->integer('precio');
            $table->string('categoria',50);
            $table->timestamps();
        });
        /*
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        */        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
