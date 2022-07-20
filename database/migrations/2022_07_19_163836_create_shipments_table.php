<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guide');
            $table->integer('peopleCity');
            $table->string('peopleReceiver');
            $table->string('peoplePhone');
            $table->integer('declaredValue');
            $table->integer('amountToReceive');
            $table->string('address');
            $table->integer('peopleIdentification');
            $table->string('shippingType')->nullable();
            $table->integer('width')->nullable();
            $table->integer('high')->nullable();
            $table->integer('long')->nullable();
            $table->integer('weight')->nullable();
            $table->string('deliverySector')->nullable();
            $table->date('toCollectDate')->nullable();
            $table->string('peopleEmail');
            $table->string('observation')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('shipments');
    }
}
