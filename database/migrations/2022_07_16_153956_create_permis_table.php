<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permis', function (Blueprint $table) {
            $table->id();
            $table->integer('Numero_pc');
            $table->string('Nom');
            $table->string('Prenom');
            $table->date('Date_reussite_permis');
            $table->date('Date_Delivrance');
            $table->date('Date_Edition');
            $table->string('Agent_delivrance');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permis');
    }
};
