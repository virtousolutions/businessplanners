<?php

class SalesForecast
extends Eloquent
{
    protected $table = "sales_forecast";
    protected $primaryKey = 'sf_id';
    public $timestamps = false;

    protected $fillable = [
		'sales_forecast_bp_id',
        'sales_forecast_name'
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
        return BusinessPlan::find($this->sales_forecast_bp_id);
    }

    public function fillForecast($data)
    {
        $business_plan = BusinessPlan::find($data['business_plan_id']);

        $first_year_total = 0;
        $save_months = ['price' => $data['price'], 'cost' => $data['cost']];

		for ($x = 0; $x < 12; $x++) 
		{															
			$array_key = 'month_' . ($x < 9 ? '0' : '') . ($x + 1);
            $save_months[$array_key] = $data['months'][$x];
            $first_year_total += $data['months'][$x];
		}

        $months_id = DB::table('sales_12_month_forecast')->where('sales_forecast_id', $this->sf_id)->pluck('smf_id');

        if ($months_id) {
            DB::table('sales_12_month_forecast')
                ->where('smf_id', $months_id)
                ->update($save_months);
        }
        else {
            $save_months['sales_forecast_id'] = $this->sf_id;
            $id = DB::table('sales_12_month_forecast')->insertGetId($save_months);
        }

        $start_year = $business_plan->getStartYear();
        $save_years[$start_year] = $first_year_total;
        $save_years[$start_year + 1] = $data['years'][1];
        $save_years[$start_year + 2] = $data['years'][2];

        foreach ($save_years as $year => $amount) {
            $year_id = DB::table('sales_financial_forecast')
                        ->where('sales_forecast_id', $this->sf_id)
                        ->where('financial_year', $year)
                        ->pluck('sff_id');

            $year_data = [
                'financial_year' => $year,
                'total_per_yr' => $amount,
                'sales_forecast_id' => $this->sf_id
            ];

            if ($year_id) {
                DB::table('sales_financial_forecast')
                    ->where('sff_id', $year_id)
                    ->update($year_data);
            }
            else {
                $id = DB::table('sales_financial_forecast')->insertGetId($year_data);
            }
        }
    }

    public static function getAll($id) 
    {
         $data = DB::table('sales_forecast')
                ->select(
                    DB::raw('
                        sales_forecast.*, 
                        sales_12_month_forecast.*, 
                        (
                            SELECT GROUP_CONCAT(total_per_yr SEPARATOR \',\') 
                            FROM sales_financial_forecast 
                            WHERE sales_financial_forecast.sales_forecast_id = sales_forecast.sf_id
                        ) as totals
                    ')
                )
                ->join('sales_12_month_forecast', 'sales_forecast.sf_id', '=', 'sales_12_month_forecast.sales_forecast_id')
                ->where('sales_forecast_bp_id', $id)
                ->get();

         return $data ? $data : [];
    }
}