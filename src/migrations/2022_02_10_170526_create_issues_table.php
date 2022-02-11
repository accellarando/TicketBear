<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        require __DIR__."/../../config.php";
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->enum('status',STATUSES); //def'd in ../../config.php
            $table->enum('category',CATEGORIES); //same
            $table->string('email');
            $table->integer('priority');
            $table->integer('assigned_to')
                  ->default(0);
            $table->tinyInteger('completed')
                  ->default(0);
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
        Schema::dropIfExists('issues');
    }
}
