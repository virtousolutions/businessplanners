<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_payments', function(Blueprint $table) {

			$table->increments('id');			
			$table->integer('user_id'); 
			$table->string('transaction_id', 50)->nullable();
			$table->string('description', 100)->nullable();
			$table->string('order_time', 50)->nullable();
			$table->double('amount')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_payments');
	}
}
