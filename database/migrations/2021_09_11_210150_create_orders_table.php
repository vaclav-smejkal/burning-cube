<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100);
            $table->string('nickname');
            $table->string('discord_tag')->nullable();
            $table->text('comment')->nullable();
            $table->string('name_surname', 200);
            $table->string('place');
            $table->string('psc');
            $table->string('surcharge');
            $table->uuid('uuid');
            $table->string('state', 60);
            $table->foreignId('package_id')->constrained("packages");
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
        Schema::dropIfExists('orders');
    }
}
