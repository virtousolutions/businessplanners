<?php

class BudgetExpenditure
extends Eloquent
{
    protected $table = "expenditure";
    protected $primaryKey = 'exp_id';
    public $timestamps = false;

    protected $fillable = [
		'expenditure_bp_id',
		'expenditure_name',
		'expenditure_start_date',
		'expected_change',
		'percentage_of_change',
        'pay_per_year',
        'pay_amount'
	];

    public static function create(array $data)
    {
        try {
            DB::beginTransaction();

            $obj = parent::create($data); 
            $obj->fillForecast($data);

            DB::commit();

        }
        catch (Exception $e) {
            DB::rollback();

            var_dump($e);

            $obj = null;
        }

        return $obj;
    }

    public function update(array $attributes = Array())
    {
        parent::update($attributes);
        $this->fillForecast($attributes);
    }

    public function businessPlan()
    {
        return BusinessPlan::find($this->expenditure_bp_id);
    }

    public function fillForecast($data)
    {
        $business_plan = $this->businessPlan();
        $expenditure_months = $data['expenditure_months'];
        $months = [];

		for ($x = 0; $x < 12; $x++)
		{															
			$array_key = 'month_' . ($x < 9 ? '0' : '') . ($x + 1);
            $months[$array_key] = $expenditure_months[$x];
		}

        // get the last year
        $year = $business_plan->getStartYear();
        $years = [$year => array_sum($months)];
        $years[$year + 1] = $years[$year];
        $years[$year + 2] = $years[$year + 1];

        $months_id = DB::table('expenditure_12_month_plan')->where('expenditure_id', $this->exp_id)->pluck('epp_id');

        if ($months_id) {
            DB::table('expenditure_12_month_plan')
                ->where('epp_id', $months_id)
                ->update($months);
        }
        else {
            $months['expenditure_id'] = $this->exp_id;
            $months['financial_yr_forecast'] = $year;
            $id = DB::table('expenditure_12_month_plan')->insertGetId($months);
        }

        foreach ($years as $year => $amount) {
            $year_id = DB::table('expenditure_financial_forecast')
                        ->where('expenditure_id', $this->exp_id)
                        ->where('financial_year', $year)
                        ->pluck('exff_id');

            $year_data = [
                'financial_year' => $year,
                'total_per_yr' => $amount,
                'related_expenses' => $business_plan->bp_related_expenses_in_percentage,
                'pay_per_year' => $amount,
                'expenditure_id' => $this->exp_id
            ];

            if ($year_id) {
                DB::table('expenditure_financial_forecast')
                    ->where('exff_id', $year_id)
                    ->update($year_data);
            }
            else {
                $id = DB::table('expenditure_financial_forecast')->insertGetId($year_data);
            }
        }
    }

    public static function getAll($id) 
    {
         $data = DB::table('expenditure')
                ->select(
                    DB::raw('
                        expenditure.*, 
                        expenditure_12_month_plan.*, 
                        (
                            SELECT GROUP_CONCAT(total_per_yr SEPARATOR \',\') 
                            FROM expenditure_financial_forecast 
                            WHERE expenditure_financial_forecast.expenditure_id = expenditure.exp_id
                        ) as totals
                    ')
                )
                ->join('expenditure_12_month_plan', 'expenditure.exp_id', '=', 'expenditure_12_month_plan.expenditure_id')
                ->where('expenditure_bp_id', $id)
                ->get();

         return $data ? $data : [];
    }
}