<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessPlanCompanyInformation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_plans', function(Blueprint $table)
		{
			$table->string('contact_name', 200);
			$table->string('address_1', 250);
            $table->string('address_2', 250)->nullable();
			$table->string('city', 100);
			$table->integer('country');
			$table->string('post_code', 20);
            $table->string('email', 100);
			$table->string('telephone', 50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_plans', function(Blueprint $table)
		{
			//
		});
	}

}
