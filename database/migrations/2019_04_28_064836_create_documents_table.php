<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->date('date_created');
            $table->integer('driver_id')->unsigned()->index();
            $table->integer('truck_id')->unsigned()->index();
            $table->float('total_kg', 13, 3);
            $table->string('sender');
            $table->string('receiver');
            $table->string('address');
            $table->text('rnote');
            $table->timestamps();

            $table->foreign('driver_id')
            ->references('id')->on('drivers')
            ->onDelete('restrict');

            $table->foreign('truck_id')
            ->references('id')->on('trucks')
            ->onDelete('restrict');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
