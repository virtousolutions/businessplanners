<?php

class BusinessPlan
extends Eloquent
{
    protected static $bp_no_financial_forecast_yr = 3; // i.e 3 or 5
	protected static $bp_releated_expenses_in_percentage = 20; //Burden Rate in percentage
	protected static $bp_income_tax_in_percentage = 0; //in percentage
	protected static $bp_yr_of_monthly_financial_details = 1; // i.e 1,2,3,4 or 5 not more than "bp_no_financial_forecast_yr"
	protected static $bp_currency = "&pound;";

    protected $fillable = [
		'bp_name',
		'bp_type',
		'bp_financial_start_date',
		'currency',
		'bp_number_of_financial_forecast_yr',
		'bp_yrs_of_monthly_financial_details',
		'bp_related_expenses_in_percentage',
		'bp_income_tax_in_percentage',
		'user_id'
	];

    protected $start_months = null;
    protected $start_year = null;
    
    public static function create(array $data)
    {
        $create_data = [];
        $start_month = htmlentities(addslashes($data['start_month']),ENT_COMPAT, "UTF-8");
        $start_year = htmlentities(addslashes($data['start_year']),ENT_COMPAT, "UTF-8");
		
        $create_data['bp_name'] = htmlentities(addslashes($data['plan_name']),ENT_COMPAT, "UTF-8");
		$create_data['bp_financial_start_date'] = date("M", strtotime($start_month)) . " " . $start_year;
		$create_data['user_id'] = $data['bp_user_id'];
		$create_data['bp_number_of_financial_forecast_yr'] = self::$bp_no_financial_forecast_yr;// 3 or 5
		$create_data['bp_yrs_of_monthly_financial_details']  = self::$bp_yr_of_monthly_financial_details;  
		$create_data['bp_related_expenses_in_percentage']  = self::$bp_releated_expenses_in_percentage; 
		$create_data['income_tax_in_percentage'] = self::$bp_income_tax_in_percentage;
		$create_data['currency'] = self::$bp_currency;

        /*echo '<pre>';
        var_dump($create_data);
        echo '</pre>';
        die;*/
		
		return parent::create($create_data);
    }

    public function ExecutiveSummary()
    {
        return $this->hasOne('ExecutiveSummary')->first();
    }

    public function BudgetExpenditure()
    {
        $id = DB::table('expenditure')->where('expenditure_bp_id', $this->id)->pluck('exp_id');
        return $id ? BudgetExpenditure::find($id) : null;
    }

    public function CashFlowProjections()
    {
        $data = DB::table('cash_flow_projection')
            ->select(
                'percentage_sale as incoming_percentage', 
                'days_collect_payments as incoming_collection', 
                'percentage_purchase as outgoing_percentage', 
                'days_make_payments as outgoing_collection'
            )
            ->where('cash_fp_bpid', $this->id)
            ->get();

        if ($data) {
            $data = $data[0];
        }

        return $data;
    }

    public function getStartYear()
    {
        if (! $this->start_year) {
            $date = strtotime($this->bp_financial_start_date);
            $this->start_year = date('Y', $date) + 1;
        }

        return $this->start_year;
    }

    public function getStartMonths()
    {
        if (! $this->start_months) {
            $start_date = strtotime($this->bp_financial_start_date);
            $start_year = date('Y', $start_date);
            $start_month = date('F', $start_date);
            $this->start_months = [];
            
            for ($x = 0; $x < 12; $x++) 
            {															
                $time = strtotime("+" . $x . " months", strtotime( $start_year . "-" . $start_month . "-01"));
                $key = date('M Y', $time);
                $this->start_months[] = $key;
            }
        }

        return $this->start_months;
    }
}