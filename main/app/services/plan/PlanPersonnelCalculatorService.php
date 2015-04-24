<?php

class PlanPersonnelCalculatorService
extends PlanCalculatorService
{
    protected $personnels;
    protected $personnels_yearly_totals;
    protected $personnels_monthly_totals;
    protected $related_expenses_yearly_totals;
    protected $related_expenses_monthly_totals;
    
    public function __construct(BusinessPlan $bp)
    {
        parent::__construct($bp);
        $this->calculate();
    }

    protected function calculate()
    {
        $this->calculateList(Employee::getAll($this->business_plan->id), 'personnels');

        $rate = $this->business_plan->bp_related_expenses_in_percentage / 100;

        $this->related_expenses_yearly_totals = [
            $this->personnels_yearly_totals[0] * $rate,
            $this->personnels_yearly_totals[1] * $rate,
            $this->personnels_yearly_totals[2] * $rate
        ];

        $this->related_expenses_monthly_totals = [
            $this->personnels_monthly_totals[0] * $rate,
            $this->personnels_monthly_totals[1] * $rate,
            $this->personnels_monthly_totals[2] * $rate,
            $this->personnels_monthly_totals[3] * $rate,
            $this->personnels_monthly_totals[4] * $rate,
            $this->personnels_monthly_totals[5] * $rate,
            $this->personnels_monthly_totals[6] * $rate,
            $this->personnels_monthly_totals[7] * $rate,
            $this->personnels_monthly_totals[8] * $rate,
            $this->personnels_monthly_totals[9] * $rate,
            $this->personnels_monthly_totals[10] * $rate,
            $this->personnels_monthly_totals[11] * $rate
        ];
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

    public function getRelatedExpensesYearlyTotals()
    {
        return $this->related_expenses_yearly_totals;
    }

    public function getRelatedExpensesMonthlyTotals()
    {
        return $this->related_expenses_monthly_totals;
    }
}