<?php

class BudgetDividend
extends Eloquent
{
    protected $table = "dividends";
    protected $primaryKey = 'dividend_id';
    public $timestamps = false;

    protected $fillable = [
		'dividend_bp_id',
		'dividend_name'
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
        return BusinessPlan::find($this->dividend_bp_id);
    }

    public function fillForecast($data)
    {
        $business_plan = $this->businessPlan();
        $dividend_months = $data['dividend_months'];
        $months = [];

		for ($x = 0; $x < 12; $x++)
		{															
			$array_key = 'month_' . ($x < 9 ? '0' : '') . ($x + 1);
            $months[$array_key] = $dividend_months[$x];
		}
        
        $year = $business_plan->getStartYear();
        $months_id = DB::table('dividend_12_month_plan')->where('dividend_id', $this->dividend_id)->pluck('dmp_id');

        if ($months_id) {
            DB::table('dividend_12_month_plan')
                ->where('dmp_id', $months_id)
                ->update($months);
        }
        else {
            $months['dividend_id'] = $this->dividend_id;
            $months['financial_yr_forecast'] = $year;
            $id = DB::table('dividend_12_month_plan')->insertGetId($months);
        }
        
        // get the last year
        $years = [
            $year => array_sum($dividend_months),
            ($year + 1) => $data['dividend_years'][1],
            ($year + 2) => $data['dividend_years'][2]
        ];

        foreach ($years as $year => $amount) {
            $year_id = DB::table('dividend_financial_forecast')
                        ->where('dividend_id', $this->dividend_id)
                        ->where('financial_year', $year)
                        ->pluck('dff_id');

            $year_data = [
                'financial_year' => $year,
                'total_per_yr' => $amount,
                'related_expenses' => $business_plan->bp_related_expenses_in_percentage,
                'dividend_id' => $this->dividend_id
            ];

            if ($year_id) {
                DB::table('dividend_financial_forecast')
                    ->where('dff_id', $year_id)
                    ->update($year_data);
            }
            else {
                $id = DB::table('dividend_financial_forecast')->insertGetId($year_data);
            }
        }
    }

    public static function getAll($id) 
    {
         $data = DB::table('dividends')
                ->select(
                    DB::raw('
                        dividends.*, 
                        dividend_12_month_plan.*, 
                        (
                            SELECT GROUP_CONCAT(total_per_yr SEPARATOR \',\') 
                            FROM dividend_financial_forecast 
                            WHERE dividend_financial_forecast.dividend_id = dividends.dividend_id
                        ) as totals
                    ')
                )
                ->join('dividend_12_month_plan', 'dividends.dividend_id', '=', 'dividend_12_month_plan.dividend_id')
                ->where('dividend_bp_id', $id)
                ->get();

         return $data ? $data : [];
    }
}