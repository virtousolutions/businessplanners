<?php

class ProfitAndLossGraphService
{
    protected $business_plan;
    protected $calculator;
    protected $images;
    protected $years;
    protected $months;

    public function __construct(BusinessPlan $bp, PlanFinancialStatementsCalculatorService $calc)
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
        $graph_creator = new GraphService();
        
        // generate the yearly sales graph
        $rel_name = "cache/graphs/yearly_net_profit_" . $this->business_plan->id . ".png";
        $physical = public_path() . "/" . $rel_name;
        
        if (file_exists($physical)) {
            unlink($physical);
        }

        $profit_loss_data = $this->calculator->getProfitAndLossYearlyData();

        $img = $graph_creator->generateBarGraph(
            [
                'datax' => $this->years, 
                'datay' => $profit_loss_data['net_profit'], 
                'title' => ''
            ], 
            [
                'value' => ['obj' => $this, 'method' => 'formatAmount']
            ],
            ['showvalue' => true]
        );

        imagepng($img, $physical, 5);
        $this->images['yearly_net_profit'] = ['path' => $rel_name, 'name' => 'Net Profit (Or Loss) by Year'];
    }

    public function getGraphs()
    {
        return $this->images;
    }

    public function formatAmount($val)
    {
        return PlanCalculatorService::formatNumberDisplay($val, 2, '£');
    }
}