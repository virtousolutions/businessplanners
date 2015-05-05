<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutiveSummariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('executive_summaries', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('business_plan_id')->unsigned();
            $table->text('who_we_are');
            $table->text('what_we_sell');
            $table->text('who_we_sell_to');
            $table->text('financial_summary');
			$table->timestamps();

            $table->foreign('business_plan_id')->references('id')->on('business_plans');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('executive_summaries');
	}

}
