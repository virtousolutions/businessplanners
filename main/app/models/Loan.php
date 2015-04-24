<?php

class Loan
extends Eloquent
{
    protected $table = "loan_investment";
    protected $primaryKey = 'li_id';
    public $timestamps = false;

    protected $fillable = [
		'loan_invest_bp_id',
        'loan_invest_name',
        'type_of_funding',
        'loan_invest_interest_rate',
        'loan_invest_years_to_pay',
        'loan_invest_pays_per_years'
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
        return BusinessPlan::find($this->loan_invest_bp_id);
    }

    public function fillForecast($data)
    {
        $business_plan = BusinessPlan::find($data['business_plan_id']);
        $first_year_total = 0;
        $save_months = [];
        
		for ($x = 0; $x < 12; $x++) 
		{															
			$array_key = 'limr_month_' . ($x < 9 ? '0' : '') . ($x + 1);
            $save_months[$array_key] = $data['months'][$x];
            $first_year_total += $data['months'][$x];
		}

        $months_id = DB::table('loan_investment_12m_received')->where('limr_loan_investment_id', $this->li_id)->pluck('limr_id');

        if ($months_id) {
            DB::table('loan_investment_12m_received')
                ->where('limr_id', $months_id)
                ->update($save_months);
        }
        else {
            $save_months['limr_loan_investment_id'] = $this->li_id;
            $id = DB::table('loan_investment_12m_received')->insertGetId($save_months);
        }

        $start_year = $business_plan->getStartYear();
        $save_years[$start_year] = $first_year_total;
        $save_years[$start_year + 1] = $data['years'][1];
        $save_years[$start_year + 2] = $data['years'][2];

        foreach ($save_years as $year => $amount) {
            $year_id = DB::table('loan_investment_received_f_yrs')
                        ->where('lir_loan_investment_id', $this->li_id)
                        ->where('lir_year', $year)
                        ->pluck('lir_id');

            $year_data = [
                'lir_year' => $year,
                'lir_total_per_yr' => $amount,
                'lir_loan_investment_id' => $this->li_id
            ];

            if ($year_id) {
                DB::table('loan_investment_received_f_yrs')
                    ->where('lir_id', $year_id)
                    ->update($year_data);
            }
            else {
                $id = DB::table('loan_investment_received_f_yrs')->insertGetId($year_data);
            }
        }
    }

    public static function getAll($id) 
    {
         $data = DB::table('loan_investment')
                ->select(
                    DB::raw('
                        loan_investment.*, 
                        loan_investment_12m_received.*, 
                        (
                            SELECT GROUP_CONCAT(lir_total_per_yr SEPARATOR \',\') 
                            FROM loan_investment_received_f_yrs 
                            WHERE loan_investment_received_f_yrs.lir_loan_investment_id = loan_investment.li_id
                        ) as totals
                    ')
                )
                ->join('loan_investment_12m_received', 'loan_investment.li_id', '=', 'loan_investment_12m_received.limr_loan_investment_id')
                ->where('loan_invest_bp_id', $id)
                ->where('type_of_funding', 'Loan')
                ->get();

         return $data ? $data : [];
    }

    public function delete()
    {
        DB::table('loan_investment_12m_received')->where('limr_loan_investment_id', $this->li_id)->delete();
        DB::table('loan_investment_received_f_yrs')->where('lir_loan_investment_id', $this->li_id)->delete();
        parent::delete();
    }
}