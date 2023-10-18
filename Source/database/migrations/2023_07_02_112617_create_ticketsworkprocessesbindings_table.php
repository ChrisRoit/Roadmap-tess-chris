<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsworkprocessesbindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketsworkprocessesbindings', function (Blueprint $table) {
            $table->unsignedBigInteger("ticket_id");
            $table->unsignedBigInteger("workprocess_id");
            $table->foreign("ticket_id")->references("id")->on("tickets")
            ->onDelete("cascade");
            $table->foreign("workprocess_id")->references("id")->on("workprocesses")
            ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("ticketsworkprocessesbindings",function(Blueprint $table){
            $table->dropForeign("ticketsworkprocessesbindings_ticket_id_foreign");
            $table->dropForeign("ticketsworkprocessesbindings_workprocess_id_foreign");
        });
        
        Schema::dropIfExists('ticketsworkprocessesbindings');
    }
}
