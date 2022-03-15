<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //quando lavoro con id o foreign key
            // do un valore intero molto grande
            // corrisponde ad un user della tabella users

            // $table->unsignedBigInteger("user_id");

            // indico che la foreign key fa riferimento alla colonna id 
            // della tabella users

            // $table->foreign("user_id")
            // ->references("id")
            // ->on("users");

            // posso scrivere tutto come
            $table->foreignId("user_id")
            ->constrained();

            // stessa cosa per le category
            // nullable può non esserci
            $table->foreignId("category_id")
            ->nullable()
            ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //tolgo il collegamento di posts che c'è con la foreign key
            $table->dropForeign("posts_user_id_foreign");
            // cancello la collonna user_id
            $table->dropColumn("user_id");
            // stessa cosa faccio con le category
            $table->dropForeign("posts_category_id_foreign");
            $table->dropColumn("category_id");
        });
    }
}
