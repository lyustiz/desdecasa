<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nb_nombres', 25);
			$table->string('nb_apellidos', 25);
			$table->string('nb_usuario')->unique();
			$table->string('password', 64);
			$table->string('tx_email')->unique();
			$table->string('tx_nuip')->nullable();
			$table->string('tx_observaciones', 100)->nullable();
			$table->rememberToken();
			$table->integer('id_status');
			$table->integer('id_usuarioe');
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
        Schema::dropIfExists('usuario');
    }
}
