<?php

class PlanBudgetCalculatorService
extends PlanCalculatorService
{
    protected $expenses;
    protected $expenses_yearly_totals;
    protected $expenses_monthly_totals;
    protected $purchases;
    protected $purchases_yearly_totals;
    protected $purchases_monthly_totals;
    
    public function __construct(BusinessPlan $bp)
    {
        parent::__construct($bp);
        $this->calculate();
    }

    protected function calculate()
    {
        $this->calculateList(BudgetExpenditure::getAll($this->business_plan->id), 'expenses');
        
        $this->purchases = BudgetPurchase::getAll($this->business_plan->id);

        $this->purchases_yearly_totals = [0, 0, 0];
        $this->purchases_monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $start_months = $this->business_plan->getStartMonths();
        
        foreach ($this->purchases as $index => $row) {
            $this->purchases_yearly_totals[0] += $row->mp_price;
             $this->purchases[$index]->totals = [$row->mp_price, 0, 0];

            for ($i = 0; $i < 12; $i++) {
                $this->purchases_monthly_totals[$i] += (($start_months[$i] == $row->mp_date) ? $row->mp_price : 0);
            }
        }
    }

    public function getExpenses()
    {
        return $this->expenses;
    }

    public function getExpensesYearlyTotals()
    {
        return $this->expenses_yearly_totals;
    }

    public function getExpensesMonthlyTotals()
    {
        return $this->expenses_monthly_totals;
    }

    public function getPurchases()
    {
        return $this->purchases;
    }

    public function getPurchasesYearlyTotals()
    {
        return $this->purchases_yearly_totals;
    }

    public function getPurchasesMonthlyTotals()
    {
        return $this->purchases_monthly_totals;
    }
}