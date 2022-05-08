<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->tinyInteger('segment')->unsigned();
            $table->string('title');
            $table->text('contents');
            $table->string('image');
            $table->boolean('online');
            $table->string('area');
            $table->integer('capacity')->unsigned();
            $table->string('contact_address');
            $table->integer('gr')->unsigned();
            $table->string('tag')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
