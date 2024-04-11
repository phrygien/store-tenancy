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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('store_code')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->integer('province_id');
            $table->integer('region_id');
            $table->integer('district_id')->nullable();
            $table->integer('commune_id')->nullable();
            $table->text('adresse');
            $table->foreignId('user_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade'); // pour la responsable du store
            $table->text('logo')->nullable();
            $table->boolean('statut')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
