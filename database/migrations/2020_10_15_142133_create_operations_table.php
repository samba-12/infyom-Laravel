<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomentreprise');
            $table->string('TypeOperation');
            $table->decimal('Solde');
            $table->date('dateOperation');
            $table->integer('numeroCompte_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('numeroCompte_id')->references('id')->on('entreprises')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('operations');
    }
}
