<?php

class BudgetGraphService
{
    protected $business_plan;
    protected $calculator;
    protected $images;
    protected $years;
    protected $months;

    public function __construct(BusinessPlan $bp, PlanBudgetCalculatorService $calc)
    {
        $this->business_plan = $bp;
        $this->calculator = $calc;
        
        $this->generate();
    }

    public function generate()
    {
        $start_year = $this->business_plan->getStartYear();
        $this->images = [];
        $this->years = ['FY' . $start_year, 'FY' . ($start_year + 1), 'FY' . ($start_year + 2)];
        $this->months = $this->business_plan->getStartMonths();
        $graph_creator = new GraphService();
        
        // generate the yearly sales graph
        $rel_name = "cache/graphs/yearly_expenses_" . $this->business_plan->id . ".png";
        $physical = public_path() . "/" . $rel_name;
        
        if (file_exists($physical)) {
            unlink($physical);
        }

        $img = $graph_creator->generateBarGraph(
            [
                'datax' => $this->years, 
                'datay' => $this->calculator->getExpensesYearlyTotals(), 
                'title' => ''
            ], 
            [
                'value' => ['obj' => $this, 'method' => 'formatAmount']
            ],
            ['showvalue' => true]
        );

        imagepng($img, $physical, 5);
        $this->images['yearly_expenses'] = ['path' => $rel_name, 'name' => 'Total Expenses by Year'];

        // generate the monthly sales graph
        $rel_name = "cache/graphs/monthly_expenses_" . $this->business_plan->id . ".png";
        $physical = public_path() . "/" . $rel_name;
        
        if (file_exists($physical)) {
            unlink($physical);
        }

        $img = $graph_creator->generateBarGraph(
            [
                'datax' => $this->months, 
                'datay' => $this->calculator->getExpensesMonthlyTotals(), 
                'title' => 'Months in Year 1'
            ], 
            [
                'value' => ['obj' => $this, 'method' => 'formatAmount']
            ],
            [
                'showvalue' => true, 
                'xaxis_label_angle' => 90, 
                'xaxis_title_margin' => 90, 
                'bottom_margin' => 150, 
                'value_angle' => 90, 
                'top_margin' => 60,
                'height' => 470
            ]
        );

        imagepng($img, $physical, 5);
        $this->images['monthly_expenses'] = ['path' => $rel_name, 'name' => 'Total Expenses by Month'];
    }

    public function getGraphs()
    {
        return $this->images;
    }

    public function formatAmount($val)
    {
        return PlanCalculatorService::formatNumberDisplay($val, 2, '£');
    }

    public function formatPercent($val)
    {
        return PlanCalculatorService::formatNumberDisplay($val, 2, '', '%');
    }
}