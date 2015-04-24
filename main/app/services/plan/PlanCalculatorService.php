<?php

class PlanCalculatorService
{
    protected $business_plan;
    
    public function __construct(BusinessPlan $bp)
    {
        $this->business_plan = $bp;
    }

    protected function calculateList($list, $name, $month_col_prefix = null, $row_month_callback = null)
    {
        $month_col_prefix = $month_col_prefix == null ? "" : $month_col_prefix;

        $yearly_totals = [0, 0, 0];
        $monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $start_months = $this->business_plan->getStartMonths();
        
        foreach ($list as $index => $row) {
            $totals = explode(",", $row->totals); 
            $yearly_totals[0] += $totals[0];
            $yearly_totals[1] += $totals[1];
            $yearly_totals[2] += $totals[2];

            for ($i = 0; $i < 12; $i++) {
                $key = $month_col_prefix . "month_" . ((($i + 1) < 10) ? '0' : '') . ($i + 1);
                $monthly_totals[$i] += $row->$key;

                if ($row_month_callback) {
                    $this->$row_month_callback($row, $key, $i);
                }
            }
            
            // set the new totals to array
            $list[$index]->totals = $totals;
        }

        $name_yearly_totals = $name . '_yearly_totals';
        $name_monthly_totals = $name . '_monthly_totals';

        $this->$name = $list;
        $this->$name_yearly_totals = $yearly_totals;
        $this->$name_monthly_totals = $monthly_totals;
    }
}