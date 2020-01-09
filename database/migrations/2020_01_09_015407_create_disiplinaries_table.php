<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisiplinariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disiplinaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('go_date', 100);
            $table->string('offence', 100);
            $table->string('nature_of_punishment', 100);
            $table->string('punishment_line_1', 100)->nullable();
            $table->string('punishment_line_2', 100)->nullable();
            $table->string('remarks', 100)->nullable();
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
        Schema::dropIfExists('disiplinaries');
    }
}
