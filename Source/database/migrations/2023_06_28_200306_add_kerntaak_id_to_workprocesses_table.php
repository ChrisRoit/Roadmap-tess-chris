<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKerntaakIdToWorkprocessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workprocesses', function (Blueprint $table) {
            //
            $table->integer("kerntaak_id")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workprocesses', function (Blueprint $table) {
            //
            $table->dropColumn("kerntaak_id");
        });
    }
}
