<?php

class Employee
extends Eloquent
{
    protected $table = "employee";
    protected $primaryKey = 'employee_id';
    public $timestamps = false;

    protected $fillable = [
		'employee_bp_id',
        'employee_name',
        'employee_start_date',
        'employee_type',
        'employee_pay_per_year',
        'employee_pay_amount'
	];

    public static function create(array $data)
    {
        try {
            DB::beginTransaction();

            $obj = parent::create($data); 
            $obj->fillForecast();

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
        $this->fillForecast();
    }

    public function businessPlan()
    {
        return BusinessPlan::find($this->employee_bp_id);
    }

    public function fillForecast()
    {
        $business_plan = $this->businessPlan();
        $start_date_str = $business_plan->bp_financial_start_date;
        $start_date = strtotime($start_date_str);
        $start_year = date('Y', $start_date);
        $start_month = date('F', $start_date);

        $first_year_total = 0;
        $start_adding_first_year_total = false;

        if ($this->employee_pay_per_year) {
            $yearly_payment = $this->employee_pay_amount;
            $monthly_payment = $this->employee_pay_amount / 12;
        }
        else {
            $yearly_payment = $this->employee_pay_amount * 12;
            $monthly_payment = $this->employee_pay_amount;
        }

        $months = [];

		for ($x = 0; $x < 12; $x++) 
		{															
			$time = strtotime("+" . $x . " months", strtotime( $start_year . "-" . $start_month . "-01"));
			$date_key = date('M Y', $time);

            if ($date_key == $this->employee_start_date) {
                $start_adding_first_year_total = true;
            }

            if ($start_adding_first_year_total == true) {
                $a = $monthly_payment;
                $first_year_total += $monthly_payment;
            }
            else {
                $a = 0;
            }

            $array_key = 'month_' . ($x < 9 ? '0' : '') . ($x + 1);
            $months[$array_key] = $a;
		}

        // get the last year
        $year = $date_key = date('Y', $time);
        $prev_amount = $yearly_payment;
        $years = [$year => $first_year_total];

        for ($i = 1; $i <= 2; $i++) {
            $change = $prev_amount * ($this->percentage_of_change / 100);
            if ($this->expected_change == 'increase') {
                $a = $prev_amount + $change;
            }
            else {
                $a = $prev_amount - $change;
            }

            $years[($year + $i)] = $a;
            $prev_amount = $a;
        }

        $months_id = DB::table('employee_12_month_plan')->where('employee_id', $this->employee_id)->pluck('mpp_id');

        if ($months_id) {
            DB::table('employee_12_month_plan')
                ->where('mpp_id', $months_id)
                ->update($months);
        }
        else {
            $months['employee_id'] = $this->employee_id;
            $months['financial_yr_forecast'] = $year;
            $id = DB::table('employee_12_month_plan')->insertGetId($months);
        }

        foreach ($years as $year => $amount) {
            $year_id = DB::table('employee_financial_forecast')
                        ->where('employee_id', $this->employee_id)
                        ->where('financial_year', $year)
                        ->pluck('eff_id');

            $year_data = [
                'financial_year' => $year,
                'total_per_yr' => $amount,
                'related_expenses' => $business_plan->bp_related_expenses_in_percentage,
                'pay_per_year' => $this->employee_pay_per_year,
                'employee_id' => $this->employee_id
            ];

            if ($year_id) {
                DB::table('employee_financial_forecast')
                    ->where('eff_id', $year_id)
                    ->update($year_data);
            }
            else {
                $id = DB::table('employee_financial_forecast')->insertGetId($year_data);
            }
        }
    }

    public static function getAll($id) 
    {
         $data = DB::table('employee')
                ->select(
                    DB::raw('
                        employee.*, 
                        employee_12_month_plan.*, 
                        (
                            SELECT GROUP_CONCAT(total_per_yr SEPARATOR \',\') 
                            FROM employee_financial_forecast 
                            WHERE employee_financial_forecast.employee_id = employee.employee_id
                        ) as totals
                    ')
                )
                ->join('employee_12_month_plan', 'employee.employee_id', '=', 'employee_12_month_plan.employee_id')
                ->where('employee_bp_id', $id)
                ->get();

         return $data ? $data : [];
    }
}