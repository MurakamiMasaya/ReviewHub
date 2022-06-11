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
        Schema::create('total_grs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('company_review_gr')->unsigned()->default(0);
            $table->integer('school_review_gr')->unsigned()->default(0);
            $table->integer('event_review_gr')->unsigned()->default(0);
            $table->integer('article_review_gr')->unsigned()->default(0);
            $table->integer('event_gr')->unsigned()->default(0);
            $table->integer('article_gr')->unsigned()->default(0);
            $table->integer('total_gr')->unsigned()->default(0);
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
        Schema::dropIfExists('total_grs');
    }
};
