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
        Schema::create('inventory_lending', function (Blueprint $table) {
            $table->id();
            $table->integer('id_item');
            $table->string('name');
            $table->string('classes');
            $table->string('no_hp');
            $table->string('needs');
            $table->string('inventory_loan_letter');
            $table->string('item_status');
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
        Schema::dropIfExists('inventory_lending');
    }
};
