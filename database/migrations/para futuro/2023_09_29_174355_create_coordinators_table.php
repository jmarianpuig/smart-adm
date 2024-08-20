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
        Schema::create('coordinators', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('name', 30);
            $table->string('first_lname', 30);
            $table->string('second_lname', 30);
            $table->string('dni', 9)->unique();
            $table->string('ss', 12)->null;
            $table->unsignedBigInteger('municipio_id');
            $table->string('adress', 80);
            $table->integer('zip_code')->lenght(5)->nullable();
            $table->integer('phone')->lenght(9);

            $table->timestamps();

            // Relaciones con otras tablas
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordinators');
    }
};
