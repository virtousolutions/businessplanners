<?php

class PlanSalesCalculatorService
extends PlanCalculatorService
{
    protected $sales;
    protected $sales_yearly_totals;
    protected $sales_monthly_totals;
    protected $money_sales_yearly_totals;
    protected $money_sales_monthly_totals;
    protected $money_cost_yearly_totals;
    protected $money_cost_monthly_totals;
    protected $gross_margin_yearly_totals;
    protected $gross_margin_yearly_percent;
    protected $gross_margin_monthly_totals;
    protected $gross_margin_monthly_percent;
    
    public function __construct(BusinessPlan $bp)
    {
        parent::__construct($bp);
        $this->calculate();
    }

    protected function calculate()
    {
        $this->money_sales_yearly_totals = [0, 0, 0];
        $this->money_cost_yearly_totals = [0, 0, 0];
        $this->gross_margin_yearly_totals = [0, 0, 0];
        $this->gross_margin_yearly_percent = [0, 0, 0];
        $this->money_sales_monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $this->money_cost_monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $this->gross_margin_monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $this->gross_margin_monthly_percent = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $this->calculateList(SalesForecast::getAll($this->business_plan->id), 'sales', null, 'calculateMonthlySales', 'calculateYearlylySales');

        $this->gross_margin_yearly_totals[0] = ($this->money_sales_yearly_totals[0] - $this->money_cost_yearly_totals[0]);
        $this->gross_margin_yearly_totals[1] = ($this->money_sales_yearly_totals[1] - $this->money_cost_yearly_totals[1]);
        $this->gross_margin_yearly_totals[2] = ($this->money_sales_yearly_totals[2] - $this->money_cost_yearly_totals[2]);

        if ($this->money_sales_yearly_totals[0] > 0) {
            $this->gross_margin_yearly_percent[0] = ($this->gross_margin_yearly_totals[0] / $this->money_sales_yearly_totals[0]) * 100;
        }
        else {
            $this->gross_margin_yearly_percent[0] = 0;
        }
        if ($this->money_sales_yearly_totals[1] > 0) {
            $this->gross_margin_yearly_percent[1] = ($this->gross_margin_yearly_totals[1] / $this->money_sales_yearly_totals[1]) * 100;
        }
        else {
            $this->gross_margin_yearly_percent[1] = 0;
        }
        if ($this->money_sales_yearly_totals[2] > 0) {
            $this->gross_margin_yearly_percent[2] = ($this->gross_margin_yearly_totals[2] / $this->money_sales_yearly_totals[2]) * 100;
        }
        else {
            $this->gross_margin_yearly_percent[2] = 0;
        }
    }

    protected function calculateYearlylySales(&$row)
    {
        $row->total_sales = [$row->totals[0] * $row->price, $row->totals[1] * $row->price, $row->totals[2] * $row->price];

        $this->money_sales_yearly_totals[0] += $row->total_sales[0];
        $this->money_sales_yearly_totals[1] += $row->total_sales[1];
        $this->money_sales_yearly_totals[2] += $row->total_sales[2];

        $row->total_costs = [$row->totals[0] * $row->cost, $row->totals[1] * $row->cost, $row->totals[2] * $row->cost];

        $this->money_cost_yearly_totals[0] += $row->total_costs[0];
        $this->money_cost_yearly_totals[1] += $row->total_costs[1];
        $this->money_cost_yearly_totals[2] += $row->total_costs[2];
    }

    protected function calculateMonthlySales($row, $key, $i)
    {
        $this->money_sales_monthly_totals[$i] += $row->$key * $row->price;
        $this->money_cost_monthly_totals[$i] += $row->$key * $row->cost;
        $this->gross_margin_monthly_totals[$i] = $this->money_sales_monthly_totals[$i] - $this->money_cost_monthly_totals[$i];
        $this->gross_margin_monthly_percent[$i] = $this->money_sales_monthly_totals[$i] > 0 ? (($this->gross_margin_monthly_totals[$i] / $this->money_sales_monthly_totals[$i]) * 100) : 0;
    }

    public function getSales()
    {
        return $this->sales;
    }

    public function getMonthlyTotalSales()
    {
        return $this->money_sales_monthly_totals;
    }

    public function getMonthlyTotalCosts()
    {
        return $this->money_cost_monthly_totals;
    }

    public function getYearlyTotalSales()
    {
        return $this->money_sales_yearly_totals;
    }

    public function getYearlyTotalDirectCosts()
    {
        return $this->money_cost_yearly_totals;
    }

    public function getYearlyGrossMargin()
    {
        return $this->gross_margin_yearly_totals;
    }

    public function getMonthlyGrossMargin()
    {
        return $this->gross_margin_monthly_totals;
    }

    public function getYearlyGrossMarginPercent()
    {
        return $this->gross_margin_yearly_percent;
    }

    public function getMonthlyGrossMarginPercent()
    {
        return $this->gross_margin_monthly_percent;
    }
}