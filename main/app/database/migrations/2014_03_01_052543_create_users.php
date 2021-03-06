<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');			
			$table->string('email', 150);
            $table->string("password")->nullable()->default(null);
            $table->string('first_name', 100);
            $table->string('last_name', 100);		
			$table->string('address_1', 250);
            $table->string('address_2', 250)->nullable();
			$table->string('city', 100);
			$table->string('state')->nullable();
			$table->integer('country');
			$table->string('post_code', 20);
            $table->string('website', 100);
			$table->string('telephone', 50);
            $table->string('mobile', 50);
            $table->string('package', '15');
            $table->string('remember_token', 200);
            $table->timestamp('expires_at');
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
		Schema::drop('users');
	}

}
