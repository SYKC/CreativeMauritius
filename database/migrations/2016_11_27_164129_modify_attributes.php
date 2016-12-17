<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update('ALTER TABLE `users` MODIFY `name` VARCHAR(255) NOT NULL');
        DB::update('ALTER TABLE `users` MODIFY `email` VARCHAR(255) NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::update('ALTER TABLE `users` MODIFY `name` VARCHAR(255) NULL');
        DB::update('ALTER TABLE `users` MODIFY `name` VARCHAR(255) NULL');
    }
}
