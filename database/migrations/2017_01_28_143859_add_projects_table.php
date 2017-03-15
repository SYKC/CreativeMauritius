<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('projects', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->text('title');
          $table->text('body');
          $table->text('featured_image');
          $table->text('tags');
          $table->boolean('permission');
          $table->integer('user_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
