<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tb_comments", function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('author');
                $table->foreign('author')
                      ->references('id')
                      ->on('users');
            $table->timestamps();
            $table->unsignedBigInteger('issue');
                $table->foreign('issue')
                      ->references('id')
                      ->on('issues');
            $table->text("comment");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_comments', function(Blueprint $table){
            $table->dropForeign("tb_comments_author_foreign");
            $table->dropForeign("tb_comments_issue_foreign");
        });
        Schema::dropIfExists("tb_comments");
    }
}
