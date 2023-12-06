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
        Schema::create('project_technology', function (Blueprint $table) {
            //colonna in relazione con project
                $table->unsignedBigInteger('project_id');
            //creazione della FK della colonna project_id
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnDelete(); // se viene cancellato un progetto a sua volta viene eliminata la relazione con la tabella ponte

                //colonna in realzione con le technology
                $table->unsignedBigInteger('technology_id');
                //creazione della Fk della colonna technology_id
                $table->foreign('technology_id')
                    ->references('id')
                    ->on('technologies')
                    ->cascadeOnDelete(); // se viene cancellato una tecnologia a sua volta viene eliminata la relazione con la tabella ponte
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
