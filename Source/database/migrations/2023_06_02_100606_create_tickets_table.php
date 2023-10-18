<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->text('opdracht');
            $table->integer("lesweek")->default(0);
            $table->integer("sbu_minuten")->default(0);
            $table->integer("bot_minuten")->default(0);
            $table->longText("vaardigheid");
            $table->longText("kennis");
            $table->longText("theorie");
            $table->text("labs");
            $table->text("thema");
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
        Schema::dropIfExists('tickets');
    }
}
