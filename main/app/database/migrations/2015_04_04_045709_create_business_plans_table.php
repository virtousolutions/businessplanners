<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_plans', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('bp_name', 255);
            $table->string('bp_type', 20);
            $table->string('bp_financial_start_date', 60);
            $table->string('currency', 60);
            $table->integer('bp_number_of_financial_forecast_yr');
            $table->integer('bp_yrs_of_monthly_financial_details');
            $table->decimal('bp_related_expenses_in_percentage', 11, 2);
            $table->decimal('bp_income_tax_in_percentage', 11, 2);
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
		Schema::drop('business_plans');
	}

}
