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
            $table->text('description');
            $table->enum('status',STATUSES); //def'd in ../../config.php
            $table->enum('category',array_keys(CATEGORIES)); //same
            $table->string('email');
            $table->integer('priority')
                  ->default(-1);
            $table->unsignedBigInteger('assigned_to')
                  ->nullable();
            $table->tinyInteger('completed')
                  ->default(0);
            $table->timestamps();
            if(count(CUSTOM_FIELDS)>1){
                foreach(CUSTOM_FIELDS as $field){
                    $table->string($field)
                          ->nullable();
                }
            }

            $table->foreign('assigned_to')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issues', function(Blueprint $table){
            $table->dropForeign("issues_assigned_to_foreign");
        });
        Schema::dropIfExists('issues');
    }
}
