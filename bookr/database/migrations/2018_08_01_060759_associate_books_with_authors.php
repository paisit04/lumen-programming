<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssociateBooksWithAuthors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('author_id')->after('id')->unsigned();
            $table->index('author_id');
            $table
                ->foreign('author_id')
                ->references('id')
                ->on('authors')
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
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_author_id_foreign');
            $table->dropIndex('books_author_id_index');
            $table->dropColumn('author_id');
        });
    }
}
