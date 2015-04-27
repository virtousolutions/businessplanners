<?php

class PlanLoansCalculatorService
extends PlanCalculatorService
{
    protected $fundings;
    protected $fundings_yearly_totals;
    protected $fundings_monthly_totals;
    protected $loans;
    protected $loans_yearly_totals;
    protected $loans_monthly_totals;
    protected $investments;
    protected $investments_yearly_totals;
    protected $investments_monthly_totals;
    
    public function __construct(BusinessPlan $bp)
    {
        parent::__construct($bp);
        $this->calculate();
    }

    protected function calculate()
    {
        $this->loans = [];
        $this->loans_yearly_totals = [0, 0, 0];
        $this->loans_monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $this->investments = [];
        $this->investments_yearly_totals = [0, 0, 0];
        $this->investments_monthly_totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $this->calculateList(Fund::getAll($this->business_plan->id), 'fundings', 'limr_', 'calculateMonthly', 'calculateYearly');
    }

    protected function calculateMonthly($row, $key, $i)
    {
        if ($row->type_of_funding == 'Loan') {
            $this->loans_monthly_totals[$i] += $row->$key;
        }
        else {
            $this->investments_monthly_totals[$i] += $row->$key;
        }
    }

    protected function calculateYearly($row)
    {
        if ($row->type_of_funding == 'Loan') {
            $this->loans[] = $row;
            $this->loans_yearly_totals[0] += $row->totals[0];
            $this->loans_yearly_totals[1] += $row->totals[1];
            $this->loans_yearly_totals[2] += $row->totals[2];
        }
        else {
            $this->investments[] = $row;
            $this->investments_yearly_totals[0] += $row->totals[0];
            $this->investments_yearly_totals[1] += $row->totals[1];
            $this->investments_yearly_totals[2] += $row->totals[2];
        }
    }

    public function getFundings()
    {
        return $this->fundings;
    }

    public function getFundingsYearlyTotals()
    {
        return $this->fundings_yearly_totals;
    }

    public function getFundingsMonthlyTotals()
    {
        return $this->fundings_monthly_totals;
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
    
    public function getInvestments()
    {
        return $this->investments;
    }

    public function getInvestmentsYearlyTotals()
    {
        return $this->investments_yearly_totals;
    }

    public function getInvestmentsMonthlyTotals()
    {
        return $this->investments_monthly_totals;
    }
}