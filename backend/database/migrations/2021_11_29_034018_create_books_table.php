<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
        
            $table->string("title")->nullable(false);
            $table->string("isbn")->nullable(false);
            $table->string("author")->nullable(false);
            $table->string("publisher_name")->nullable(false);
            $table->string("image_url")->nullable(false);
            $table->date("sales_date")->nullable(false);
            $table->string("url")->nullable(false);

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
        Schema::dropIfExists('books');
    }
}
