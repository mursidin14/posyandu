<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenimbangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penimbangans', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_timbang')->nullable();
            $table->integer('user_id')->nullable();
            $table->foreignId('balita_id')->constrained('balitas')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->decimal('bb')->nullable();
            $table->decimal('tb')->nullable();
            $table->timestamps();
            $table->string('catatan')->nullable();
            $table->string('acara_kegiatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penimbangans');
    }
}
