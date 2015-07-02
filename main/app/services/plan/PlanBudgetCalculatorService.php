<?php

class PlanBudgetCalculatorService
extends PlanCalculatorService
{
    protected $personnel_calculator;
    protected $expenses;
    protected $expenses_yearly_totals;
    protected $expenses_monthly_totals;
    protected $purchases;
    protected $purchases_yearly_totals;
    protected $purchases_monthly_totals;
    protected $dividends;
    protected $dividends_yearly_totals;
    protected $dividends_monthly_totals;
    
    public function __construct(BusinessPlan $bp, PlanPersonnelCalculatorService $personnel_calc)
    {
        parent::__construct($bp);
        $this->personnel_calculator = $personnel_calc;
        $this->calculate();
    }

    protected function calculate()
    {
        $this->calculateList(BudgetExpenditure::getAll($this->business_plan->id), 'expenses');
        $this->calculateList(BudgetDividend::getAll($this->business_plan->id), 'dividends');
        
        $personnels = $this->getPersonnelsYearlyTotals();
        $related_expenses_yearly_totals = $this->getRelatedExpensesYearlyTotals();

        $this->expenses_yearly_totals[0] += $personnels[0] + $related_expenses_yearly_totals[0];
        $this->expenses_yearly_totals[1] += $personnels[1] + $related_expenses_yearly_totals[1];
        $this->expenses_yearly_totals[2] += $personnels[2] + $related_expenses_yearly_totals[2];

        $personnels = $this->getPersonnelsMonthlyTotals();
        $related_expenses_monthly_totals = $this->getRelatedExpensesMonthlyTotals();

        for ($i = 0; $i < 12; $i++) {
            $this->expenses_monthly_totals[$i] += $personnels[$i] + $related_expenses_monthly_totals[$i];
        }
        
        $this->purchases = BudgetPurchase::getAll($this->business_plan->id);

        $this->purchases_yearly_totals = [0, 0, 0];
        $this->purchases_monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $start_months = $this->business_plan->getStartMonths();
        
        foreach ($this->purchases as $index => $row) {
            $this->purchases[$index]->totals = [0, 0, 0];

            if (strpos($row->mp_date,'Year 2') !== false) {
                $this->purchases_yearly_totals[1] += $row->mp_price;
                $this->purchases[$index]->totals[1] = $row->mp_price;
            }
            else if (strpos($row->mp_date,'Year 3') !== false) {
                $this->purchases_yearly_totals[2] += $row->mp_price;
                $this->purchases[$index]->totals[2] = $row->mp_price;
            }
            else {
                $this->purchases_yearly_totals[0] += $row->mp_price;
                $this->purchases[$index]->totals[0] = $row->mp_price;

                for ($i = 0; $i < 12; $i++) {
                    $this->purchases_monthly_totals[$i] += (($start_months[$i] == $row->mp_date) ? $row->mp_price : 0);
                }
            }
        }
    }

    public function getPersonnelsYearlyTotals()
    {
        return $this->personnel_calculator->getPersonnelsYearlyTotals();
    }

    public function getPersonnelsMonthlyTotals()
    {
        return $this->personnel_calculator->getPersonnelsMonthlyTotals();
    }

    public function getRelatedExpensesYearlyTotals()
    {
        return $this->personnel_calculator->getRelatedExpensesYearlyTotals();
    }

    public function getRelatedExpensesMonthlyTotals()
    {
        return $this->personnel_calculator->getRelatedExpensesMonthlyTotals();
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

    public function getDividends()
    {
        return $this->dividends;
    }

    public function getDividendsYearlyTotals()
    {
        return $this->dividends_yearly_totals;
    }

    public function getDividendsMonthlyTotals()
    {
        return $this->dividends_monthly_totals;
    }
}