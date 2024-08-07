<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImunisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imunisasi', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_imun');
            $table->foreignId('balita_id')->constrained('balitas')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('umur');
            $table->foreignId('jenis_imun')->constrained('jenis_imuns')->onDelete('cascade')->onUpdate('casCade')->nullable(true);
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
        Schema::dropIfExists('imunisasi');
    }
}
