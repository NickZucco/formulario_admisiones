<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
			$table->string('document');
			$table->integer('document_type');
			$table->integer('program');
            $table->integer('isadmin')->default('0');
            $table->rememberToken();
            $table->timestamps();
            
            $table->boolean('activated')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
