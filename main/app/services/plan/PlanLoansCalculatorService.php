<?php

class PlanLoansCalculatorService
extends PlanCalculatorService
{
    protected $loans;
    protected $loans_yearly_totals;
    protected $loans_monthly_totals;
    
    public function __construct(BusinessPlan $bp)
    {
        parent::__construct($bp);
        $this->calculate();
    }

    protected function calculate()
    {
        $this->calculateList(Loan::getAll($this->business_plan->id), 'loans', 'limr_');
    }

    public function getLoans()
    {
        return $this->loans;
    }

    public function getLoansYearlyTotals()
    {
        return $this->loans_yearly_totals;
    }

    public function getLoansMonthlyTotals()
    {
        return $this->loans_monthly_totals;
    }

}