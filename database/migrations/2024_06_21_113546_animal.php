<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('value');
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('tax_id')->constrained('taxes')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->constrained('types')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->longText('description');
            $table->enum('state', ['en vente', 'vendu']);
            $table->longText('pictures');
            $table->foreignId('type_id')->constrained('types')->cascadeOnDelete();
            $table->foreignId('race_id')->constrained('races')->cascadeOnDelete();
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['race_id']);
        });

        Schema::dropIfExists('animals');
        Schema::dropIfExists('races');
        Schema::dropIfExists('types');
        Schema::dropIfExists('taxes');
    }
};
