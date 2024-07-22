<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelahiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelahirans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orang_tua_id')->nullable();
            $table->foreignId('ayah_id')->nullable();
            $table->foreignId('balita_id')->nullable();
            $table->integer('jumlah_lahiran')->nullable()->default(0);
            $table->string('jenis_kelamin')->nullable();
            $table->string('tgl')->nullable();
            $table->string('status_ibu')->nullable();
            $table->string('status_bayi')->nullable();
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
        Schema::dropIfExists('kelahirans');
    }
}
