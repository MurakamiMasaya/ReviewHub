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
        Schema::create('review_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('event_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->text('review');
            $table->integer('gr')->unsigned()->default(0);
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
        Schema::dropIfExists('review_events');
    }
};