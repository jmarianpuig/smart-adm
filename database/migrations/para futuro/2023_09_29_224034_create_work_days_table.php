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
        Schema::create('work_days', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('proyect_id');
            $table->unsignedBigInteger('user_id');

            // TODO definir el resto de campo de la tabla de los proyectos


            $table->timestamps();

            $table->foreign('proyect_id')
                ->references('id')
                ->on('proyects')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_days');
    }
};
