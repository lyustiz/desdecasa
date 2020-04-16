<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_comercio');
            $table->string('tx_email', 30);
			$table->string('tx_sitio_web', 30)->nullable();
			$table->string('tx_facebook', 30)->nullable();
			$table->string('tx_twitter', 30)->nullable();
			$table->string('tx_instagram', 30)->nullable();
			$table->string('tx_youtube', 30)->nullable();
			$table->string('tx_observaciones', 100)->nullable();
			$table->integer('id_status');
			$table->integer('id_usuario');
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
        Schema::dropIfExists('contacto');
    }
}
