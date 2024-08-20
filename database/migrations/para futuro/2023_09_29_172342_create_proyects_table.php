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
        Schema::create('proyects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coordinator_id')->default(1);
            $table->unsignedBigInteger('customer_id')->default(1);
            $table->string('name', 80);
            $table->text('description', 250)->nullable();
            $table->unsignedBigInteger('municipio_id');
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->unsignedBigInteger('proyect_status_id')->default(1);

            $table->timestamps();

            // Relaciones con otras tablas
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('coordinator_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('proyect_status_id')
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
        Schema::dropIfExists('proyects');
    }
};
