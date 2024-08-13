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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_matiere');
             $table->foreignId('id_student');
             $table->integer('note_TP');
             $table->integer('note_TD');
             $table->integer('note_examen');
             $table->integer('coef_note_TP');
             $table->integer('coef_note_TD');
             $table->integer('coef_note_examen');
             $table->string('periode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
