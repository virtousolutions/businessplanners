<?php

class ExecutiveSummary
extends Eloquent
{
    protected $table = "executive_summaries";

    protected $fillable = [
		'business_plan_id',
		'who_we_are',
		'what_we_sell',
		'who_we_sell_to',
		'financial_summary',
		'created_at',
		'updated_at'
	];

    public function businessPlan()
    {
        return $this->belongsTo('BusinessPlan')->first();
    }
}