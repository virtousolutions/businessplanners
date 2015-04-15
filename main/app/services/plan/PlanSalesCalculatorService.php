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
    
    public function __construct(BusinessPlan $bp)
    {
        parent::__construct($bp);
        $this->calculate();
    }

    protected function calculate()
    {
        $this->calculateList(SalesForecast::getAll($this->business_plan->id), 'sales');

        $this->money_sales_yearly_totals = [0, 0, 0];
        $this->money_cost_yearly_totals = [0, 0, 0];
        $this->gross_margin_yearly_totals = [0, 0, 0];
        $this->gross_margin_yearly_percent = [0, 0, 0];

        foreach ($this->sales as $index => $sale) {
            $sale->total_sales = [$sale->totals[0] * $sale->price, $sale->totals[1] * $sale->price, $sale->totals[2] * $sale->price];

            $this->money_sales_yearly_totals[0] += $sale->total_sales[0];
            $this->money_sales_yearly_totals[1] += $sale->total_sales[1];
            $this->money_sales_yearly_totals[2] += $sale->total_sales[2];

            $sale->total_costs = [$sale->totals[0] * $sale->cost, $sale->totals[1] * $sale->cost, $sale->totals[2] * $sale->cost];

            $this->money_cost_yearly_totals[0] += $sale->total_costs[0];
            $this->money_cost_yearly_totals[1] += $sale->total_costs[1];
            $this->money_cost_yearly_totals[2] += $sale->total_costs[2];
        }

        $this->gross_margin_yearly_totals[0] = ($this->money_sales_yearly_totals[0] - $this->money_cost_yearly_totals[0]);
        $this->gross_margin_yearly_totals[1] = ($this->money_sales_yearly_totals[1] - $this->money_cost_yearly_totals[1]);
        $this->gross_margin_yearly_totals[2] = ($this->money_sales_yearly_totals[2] - $this->money_cost_yearly_totals[2]);

        $this->gross_margin_yearly_percent[0] = ($this->gross_margin_yearly_totals[0] / $this->money_sales_yearly_totals[0]) * 100;
        $this->gross_margin_yearly_percent[1] = ($this->gross_margin_yearly_totals[1] / $this->money_sales_yearly_totals[1]) * 100;
        $this->gross_margin_yearly_percent[2] = ($this->gross_margin_yearly_totals[2] / $this->money_sales_yearly_totals[2]) * 100;

        /*echo '<pre>';
        var_dump($this->sales);
        var_dump($this->sales_monthly_totals);
        var_dump($this->sales_yearly_totals);
        var_dump($this->money_sales_yearly_totals);
        var_dump($this->money_cost_yearly_totals);
        var_dump($this->gross_margin_yearly_totals);
        var_dump($this->gross_margin_yearly_percent);
        die;*/
    }

    public function getSales()
    {
        return $this->sales;
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

    public function getYearlyGrossMarginPercent()
    {
        return $this->gross_margin_yearly_percent;
    }
}