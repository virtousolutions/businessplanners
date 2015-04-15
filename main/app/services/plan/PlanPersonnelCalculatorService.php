<?php

class PlanPersonnelCalculatorService
extends PlanCalculatorService
{
    protected $personnels;
    protected $personnels_yearly_totals;
    protected $personnels_monthly_totals;
    
    public function __construct(BusinessPlan $bp)
    {
        parent::__construct($bp);
        $this->calculate();
    }

    protected function calculate()
    {
        $this->calculateList(Employee::getAll($this->business_plan->id), 'personnels');
    }

    public function getPersonnels()
    {
        return $this->personnels;
    }

    public function getPersonnelsYearlyTotals()
    {
        return $this->personnels_yearly_totals;
    }

    public function getPersonnelsMonthlyTotals()
    {
        return $this->personnels_monthly_totals;
    }
}