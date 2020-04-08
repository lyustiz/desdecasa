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
			$table->string('nb_nombres', 25)->nullable();
			$table->string('nb_usuario')->unique();
			$table->string('password', 64);
			$table->string('tx_email')->unique();
            $table->string('fe_nacimiento')->nullable();
            $table->string('tx_sexo')->nullable();
            $table->string('tx_foto')->nullable();
            $table->string('tx_observaciones', 100)->nullable();
            $table->string('verification', 64)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('api_token', 64)->nullable();
			$table->integer('id_status');
			$table->integer('id_usuario')->nullable();
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
