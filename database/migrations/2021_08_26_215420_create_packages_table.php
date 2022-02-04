<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('sanitized_name', 100);
            $table->text('comment');
            $table->unsignedFloat("price");
            $table->unsignedFloat("sms_price");
            $table->integer("is_one_time");
            $table->char("color")->default('#fd7e14');
            $table->string('image')->default("/img/grass-block.png");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
