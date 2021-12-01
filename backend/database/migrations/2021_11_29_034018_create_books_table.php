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
        
            $table->string("title")->nullable(true);
            $table->text("description")->nullable(true);
            $table->string("isbn")->nullable(true);
            $table->string("author")->nullable(true);
            $table->string("publisher_name")->nullable(true);
            $table->string("image_url")->nullable(true);
            $table->date("sales_date")->nullable(true);
            $table->string("url")->nullable(true);

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
