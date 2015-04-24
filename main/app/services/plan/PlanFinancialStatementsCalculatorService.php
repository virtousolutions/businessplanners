<?php
class PlanFinancialStatementsCalculatorService 
{

	public $currency	= "";
	public $months		= array();
	public $years		= array();
	public $fyyears		= array();
	
	// Sales & Direct Costs	
	public $monthlyunitsales	= array();
	public $monthlypriceperunit	= array();
	public $monthlysales		= array();
	public $monthlytotalsales	= array();
	
	public $monthlydirectunitcosts	= array();
	public $monthlydirectcosts		= array();
	public $monthlytotaldirectcosts = array();
	
	public $monthlygrossmargin		= array();
	public $monthlygrossmarginpercent	= array();
	
	public $yearlyunitsales		= array();
	public $yearlypriceperunit	= array();
	public $yearlysales			= array();
	public $yearlytotalsales	= array();
	
	public $yearlydirectunitcosts	= array();
	public $yearlydirectcosts		= array();
	public $yearlytotaldirectcosts	= array();
	
	public $yearlygrossmargin		= array();
	public $yearlygrossmarginpercent= array();
	
	//End Sales & Direct Costs
	
	//Personnel Plan
	public $monthlysalary		= array();
	public $monthlytotalsalary 	= array();
	
	public $yearlysalary		= array();
	public $yearlytotalsalary	= array();
	//End Personnel Plan
	
	//Budget
	//Salary is in $monthlysalary
	public $monthlyemployeeexpenses		= array();	
	public $monthlyexpenses				= array();
	public $monthlytotaloperatingexpenses = array();
	
	public $monthlymajorpurchases		= array();	
	public $monthlytotalmajorpurchases	= array();
	
	public $yearlyemployeeexpenses		= array();
	public $yearlyexpenses				= array();
	public $yearlytotaloperatingexpenses = array();
	
	public $yearlymajorpurchases		= array();	
	public $yearlytotalmajorpurchases	= array();
	
	public $monthlydepreciation			= array();
	public $monthlyaccudepreciation	= array();
	
	//End Budget
	
	//Loans and Investments
	public $monthlyloans				= array();
	public $monthlytotalamountreceive	= array();
	
	public $monthlyrepayments			= array(); //estimated repayment	
	public $monthlyestimatedbalance		= array();
	public $monthlyestimatedinterest	= array();
	
	public $monthlytotalamountrepaid	= array(); //estimated repayment
	public $monthlytotalbalance			= array(); //estimated repayment
	public $monthlytotalinterest		= array();
	
	public $yearlyloans					= array();
	public $yearlytotalloans			= array();
	public $yearlyamountreceive			= array();
	public $yearlyamountrepaid			= array();
	public $yearlyinterest				= array();
	public $yearlyrepayments			= array();

	
	//Investments
	public $monthlyinvestments						= array();
	public $monthlyinvestmentsrepaid				= array();
	public $monthlytotalinvestmentsamountreceive	= array();
	public $monthlytotalinvestmentsamountrepaid		= array();
		
	public $yearlyinvestment						= array();
	public $yearlytotalinvestment					= array();
	public $yearlynetinvestment						= array();
	
	
	
	
	//End Loans and Investments

	
	//Profit and Loss
	public $monthlyoperatingincome 		= array();
	public $monthlypretaxprofit			= array();
	public $monthlyincometax			= array();
	public $monthlytotalexpenses		= array();
	public $monthlynetprofit			= array();
	
	public $yearlyrevenue				= array();
	public $yearlydirectcost			= array();
	public $yearlypfgrossmargin			= array();
	public $yearlypfgrossmarginpercent	= array();
	
	public $yearlyoperatingincome		= array();
	public $yearlydepreciation			= array();
	public $yearlypretaxprofit			= array();
	public $yearlyincometax				= array();
	public $yearlytotalexpenses			= array();
	public $yearlynetprofit				= array();
	public $yearlynetprofitpercent		= array();
	//End of Profit and Loss
	

	//Accounts Receivable
	public $monthlyaccountsreceivable	= array();	
	public $monthlyreceivabletotalcashcollected	= array();
	public $truemonthlyaccountsreceivable = array();
	//End Accounts Receivable
	
	//Accounts Payable
	public $monthlyaccountspayable		= array();
	public $monthlypayabletotalcashcolleted	= array();
	//End Accounts Payable
	
	//Balance Sheet
	public $monthlycash					= array();
	public $monthlytotalcurrentassets	= array();
	public $monthlylongtermassets	= array();
	public $monthlytotallongtermassets	= array();
	public $monthlytotalassets			= array();
	
	public $monthlytotalliability		= array();
	public $monthlypaidincapital		= array();
	public $monthlyretainedearnings		= array();
	public $monthlyearnings				= array();
	public $monthlyownerequity			= array();
	public $monthlyliabilityandequity	= array();
	
	public $yearlycash					= array();
	public $yearlyaccountsreceivable	= array();
	public $yearlytotalcurrentassets	= array();
	public $yearlylongtermassets		= array();
	public $yearlyaccudepreciation		= array();
	public $yearlytotallongtermassets	= array();
	public $yearlytotalassets			= array();
	
	public $yearlyaccountspayable		= array();
	public $yearlytotalcurrentliabilities	= array();
	public $yearlylongtermdebt			= array();
	public $yearlytotalliabilities		= array();
	public $yearlyretainedearnings		= array();
	public $yearlyearnings				= array();
	public $yearlytotalownerequity		= array();
	public $yearlytotalliabilityandEquity	= array();
	
	
	//End Balance Sheet
	
	//Cash Flow
	public $changeinaccountsreceivable		= array();
	public $changeinaccountspayable			= array();
	
	public $assetspurchasedorsold			= array();
	public $changeinlongtermdebt			= array();
	
	public $netcashflowfromoperations		= array(); 
	public $netcashflowfrominvesting		= array();
	public $cashatbeginningofperiod			= array();
	public $netchangeincash					= array();
	public $cashatendofperiod				= array();
	
	
	public $yearlychangeinaccountsreceivable	= array();
	public $yearlychangeinaccountspayable		= array();
	
	public $yearlyassetspurchasedorsold			= array();
	public $yearlychangeinlongtermdebt			= array();
	
	public $yearlynetcashflowfromoperations		= array();
	public $yearlynetcashflowfrominvesting		= array();
	public $yearlycashatbeginningofperiod		= array();
	public $yearlynetchangeincash				= array();
	public $yearlycashatendofperiod				= array();

    protected $business_plan = null;
    protected $sales_calc = null;
    protected $personnel_calc = null;
    protected $budget_calc = null;
    protected $loans_calc = null;
	
    protected $monthly_operating_income = null;
    protected $yearly_operating_income = null;
    protected $yearly_total_interests = null;
    protected $yearly_depreciation = null;
    protected $yearly_income_tax = null;
    protected $yearly_net_profit = null;

    public function __construct(
        BusinessPlan $plan, 
        PlanSalesCalculatorService $sales_calc, 
        PlanPersonnelCalculatorService $personnel_calc,
        PlanBudgetCalculatorService $budget_calc,
        PlanLoansCalculatorService $loans_calc
    )
    {
        $this->business_plan = $plan;
        $this->sales_calc = $sales_calc;
        $this->personnel_calc = $personnel_calc;
        $this->budget_calc = $budget_calc;
        $this->loans_calc = $loans_calc;

        $this->calculate();
    }
	
	public function calculate()
	{
        $this->cash_flow_data = $this->business_plan->CashFlowProjections();

        $this->calculateOperatingIncome();
        $this->calculateInterestRate();
        $this->calculateDepreciation();
        
        $pre_tax_profit = [
            $this->yearly_operating_income[0] - $this->yearly_total_interests[0] - $this->yearly_depreciation[0],
            $this->yearly_operating_income[1] - $this->yearly_total_interests[1] - $this->yearly_depreciation[1],
            $this->yearly_operating_income[2] - $this->yearly_total_interests[2] - $this->yearly_depreciation[2]
        ];
        
        $this->yearly_income_tax = [
            $pre_tax_profit[0] * ($this->business_plan->bp_income_tax_in_percentage / 100),
            $pre_tax_profit[1] * ($this->business_plan->bp_income_tax_in_percentage / 100),
            $pre_tax_profit[2] * ($this->business_plan->bp_income_tax_in_percentage / 100)
        ];
        
        $this->yearly_net_profit = [
            $pre_tax_profit[0] - $this->yearly_income_tax[0], 
            $pre_tax_profit[1] - $this->yearly_income_tax[1], 
            $pre_tax_profit[2] - $this->yearly_income_tax[2], 
        ];

        $yearly_expenses = $this->budget_calc->getExpensesYearlyTotals();

        $this->yealy_total_expenses = [
            $yearly_expenses[0] + $this->yearly_total_interests[0] + $this->yearly_depreciation[0] + $this->yearly_income_tax[0],
            $yearly_expenses[1] + $this->yearly_total_interests[1] + $this->yearly_depreciation[1] + $this->yearly_income_tax[1],
            $yearly_expenses[2] + $this->yearly_total_interests[2] + $this->yearly_depreciation[2] + $this->yearly_income_tax[2],
        ];
        
        
        $this->calculateAccountsReceivable();
        $this->calculateAccountsPayable();
        $this->calculateBalanceSheet();
        
        //$this->calculateProfitAndLoss();
		//$this->calculateAccountsReceivable();
		//$this->calculateBalanceSheet();
		//$this->calculateCashFlow();
	}

    protected function calculateOperatingIncome()
    {
        /*** Calculate the operating income **/
        $monthly_gross = $this->sales_calc->getMonthlyGrossMargin();
        $monthly_expenses = $this->budget_calc->getExpensesMonthlyTotals();
        $this->monthly_operating_income = [];

        for ($x = 0; $x < 12; $x++) {
            $this->monthly_operating_income[$x] = $monthly_gross[$x] - $monthly_expenses[$x];
        }

        $yearly_gross = $this->sales_calc->getYearlyGrossMargin();
        $yearly_expenses = $this->budget_calc->getExpensesYearlyTotals();
        $this->yearly_operating_income = [];

        for ($x = 0; $x < 3; $x++) {
            $this->yearly_operating_income[$x] = $yearly_gross[$x] - $yearly_expenses[$x];
        }

        /*** End calculating the operating income **/
    }

    protected function calculateInterestRate()
    {
        /*** Calculate the interest rate **/
        $loans = Loan::getAll($this->business_plan->id);
        $monthly_total_repayments = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_balance = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_interest = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_loans = $this->loans_calc->getLoansMonthlyTotals();

        foreach ($loans as $loan) {
            $interest_rate = $loan->loan_invest_interest_rate / 100;
			$period	= $loan->loan_invest_pays_per_years;
			$terms	= $loan->loan_invest_years_to_pay;
			$pmtperiod = $period * $terms;
			
			//monthly repayment
            $repayments = [];
            $balance = [];
            $interest = [];
			$tmp_sum = 0;
						
			for($i = 0; $i < 12; $i++) {
                $key = "limr_month_" . ((($i + 1) < 10) ? '0' : '') . ($i + 1);
                $tmp_sum  += $loan->$key;

                //monthly estimated repayments
				if($i == 0 || $balance[$i - 1] == 0 || $tmp_sum == 0){
					$repayments[$i] = 0;
				} else {
					$repayments[$i] = -self::PMT($interest_rate / $period, $pmtperiod, $tmp_sum);
				}
				
				//monthly estimated interest
				if($i == 0 || $balance[$i - 1] == 0) {
					$interest[$i] = 0;
				} else {
                    $interest[$i] = -self::IPMT($interest_rate / $period, 1, $pmtperiod, $tmp_sum);
				}
			    
                //monthly balance
				$balance[$i] = ($i > 0 ? $balance[$i - 1] : 0) + $loan->$key - $repayments[$i] + $interest[$i];
				
                $monthly_total_repayments[$i] += $repayments[$i];
                $monthly_total_balance[$i]    += $balance[$i];
                $monthly_total_interest[$i]   += $interest[$i];
			}
        }

        $total_interest = array_sum($monthly_total_interest);
        $yearly_total_loans = $this->loans_calc->getLoansYearlyTotals();

        // Verify if this is the correct calculation
        $this->yearly_total_interests = [$total_interest, $total_interest, $total_interest];
        
        $this->yearly_total_repayments[0] = array_sum($monthly_total_repayments);
        $this->yearly_total_repayments[1] = ($yearly_total_loans[0] - $this->yearly_total_repayments[0] + $this->yearly_total_interests[0] + $yearly_total_loans[1]) > 0 ? $this->yearly_total_repayments[0] : 0;
        $this->yearly_total_repayments[2] = ($yearly_total_loans[0] - $this->yearly_total_repayments[0] + $this->yearly_total_interests[0] + $yearly_total_loans[1] - $this->yearly_total_repayments[1] + $this->yearly_total_interests[1] + $yearly_total_loans[2]) > 0 ? $this->yearly_total_repayments[0] : 0;
        
        /*** End calculating interest rate **/

        $this->monthly_total_interest = $monthly_total_interest;
        $this->monthly_total_repayments = $monthly_total_repayments;
        $this->monthly_total_balance = $monthly_total_balance;
    }

    protected function calculateDepreciation()
    {
        $monthly_total_interest = $this->monthly_total_interest;

        /*** Calculate depreciation **/
        $purchases = $this->budget_calc->getPurchases();
        $monthly_depreciation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_accumulated_depreciation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_income_tax = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $start_months = $this->business_plan->getStartMonths();
        
        foreach ($purchases as $purchase) {
            if ($purchase->mp_depreciate == 0) {
                continue;
            }

            for ($i = 0; $i < 12; $i++) {
                $monthly_depreciation[$i] += ((($start_months[$i] == $purchase->mp_date) ? $purchase->mp_price : 0) * (0.2 / 12));
            }
        }

        for ($i = 0; $i < 12; $i++) {
            $monthly_accumulated_depreciation[$i] = ($i == 0? 0 : $monthly_accumulated_depreciation[$i - 1]) + $monthly_depreciation[$i];
            $monthly_income_tax[$i] = ($this->monthly_operating_income[$i] - $monthly_total_interest[$i] - $monthly_accumulated_depreciation[$i]) * ($this->business_plan->bp_income_tax_in_percentage / 100);
        }

        $yearly_purchases = $this->budget_calc->getPurchasesYearlyTotals();
        $monthly_purchases = $this->budget_calc->getPurchasesMonthlyTotals();

        $this->yearly_depreciation = [array_sum($monthly_accumulated_depreciation), 0, 0];
        $this->yearly_depreciation[1] = ($yearly_purchases[0] + $yearly_purchases[1] - $this->yearly_depreciation[0]) * 0.2;
        $this->yearly_depreciation[2] = ($yearly_purchases[0] + $yearly_purchases[1] + $yearly_purchases[2] - $this->yearly_depreciation[0] - $this->yearly_depreciation[1]) * 0.2;
        /*** End calculating depreciation **/

        $this->monthly_accumulated_depreciation = $monthly_accumulated_depreciation;
        $this->monthly_income_tax = $monthly_income_tax;
    }

    protected function calculateAccountsReceivable()
    {
        $cash_flow_data = $this->cash_flow_data;
        $total_sales = $this->sales_calc->getMonthlyTotalSales();

        $percent_on_credit = $cash_flow_data->incoming_percentage / 100;
		$days_to_collect   = $cash_flow_data->incoming_collection;
        $index_to_collect  = $days_to_collect / 30;

        $monthly_cash_collected    = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_receivable        = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $total_cash_collected      = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $total_accounts_receivable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        for ($i = 0; $i < 12; $i++) {
            $credit_amount = $total_sales[$i] * $percent_on_credit;
            $monthly_cash_collected[$i] = $total_sales[$i] - $credit_amount;
            $monthly_receivable[$i] = $credit_amount;
            
            $j = $i - $index_to_collect;
            $other_receivable = $j > 0 ? $monthly_receivable[$j] : 0;

            $total_cash_collected[$i] = $monthly_cash_collected[$i] + $other_receivable;
            $total_accounts_receivable[$i] = ($i > 0 ? $total_accounts_receivable[$i - 1] : 0) + $total_sales[$i] - $total_cash_collected[$i];
        }

        $this->monthly_cash_collected = $total_cash_collected;
        $this->monthly_accounts_receivable = $total_accounts_receivable;
    }

    protected function calculateAccountsPayable()
    {
        $cash_flow_data = $this->cash_flow_data;
        $total_costs = $this->sales_calc->getMonthlyTotalCosts();
        $monthly_expenses = $this->budget_calc->getExpensesMonthlyTotals();

        $percent_on_credit = $cash_flow_data->outgoing_percentage / 100;
		$days_to_pay       = $cash_flow_data->outgoing_collection;
        $index_to_pay      = $days_to_pay / 30;

        $monthly_payable_amount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_cash_paid      = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_payable        = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $total_cash_collected   = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $total_accounts_payable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        for ($i = 0; $i < 12; $i++) {
            $payable = $total_costs[$i] + $monthly_expenses[$i];
            $credit_amount = $payable * $percent_on_credit;
            $monthly_payable_amount[$i] = $payable;
            $monthly_cash_paid[$i] = $payable - $credit_amount;
            $monthly_payable[$i] = $credit_amount;
            
            $j = $i - $index_to_pay;
            $other_payable = $j > 0 ? $monthly_payable[$j] : 0;

            $total_cash_collected[$i]   = $monthly_cash_paid[$i] + $other_payable;
            $total_accounts_payable[$i] = ($i > 0 ? $total_accounts_payable[$i - 1] : 0) + $payable - $total_cash_collected[$i];
        }

        $this->monthly_cash_paid = $total_cash_collected;
        $this->monthly_accounts_payable = $total_accounts_payable;
    }

    public function calculateBalanceSheet()
    {
        $monthly_salaries = $this->personnel_calc->getPersonnelsMonthlyTotals();
        $monthly_related_expenses = $this->personnel_calc->getRelatedExpensesMonthlyTotals();
        $monthly_total_loans = $this->loans_calc->getLoansMonthlyTotals();
        $monthly_purchases = $this->budget_calc->getPurchasesMonthlyTotals();
        $starting_cash = 0;
        $monthly_cash = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i < 12; $i++) {
            $monthly_cash[$i] = ($i == 0 ? $starting_cash : $monthly_cash[$i - 1]) 
                + $monthly_total_loans[$i] - $this->monthly_total_repayments[$i] + $this->monthly_total_interest[$i]
                + $this->monthly_cash_collected[$i] - $this->monthly_cash_paid[$i]
                - $monthly_salaries[$i] - $monthly_related_expenses[$i]
                - $this->monthly_total_interest[$i] - $this->monthly_accumulated_depreciation[$i]
                - $this->monthly_income_tax[$i] + ($monthly_purchases[$i] * -1);
        }

        $yearly_total_sales     = $this->sales_calc->getYearlyTotalSales();
        $yearly_total_loans     = $this->loans_calc->getLoansYearlyTotals();
        $yearly_total_purchases = $this->budget_calc->getPurchasesYearlyTotals();

        $this->yearly_accounts_receivable[0] = $this->monthly_accounts_receivable[11];
        $this->yearly_accounts_receivable[1] = $this->yearly_accounts_receivable[0] / $yearly_total_sales[0] * $yearly_total_sales[1];
        $this->yearly_accounts_receivable[2] = $this->yearly_accounts_receivable[0] / $yearly_total_sales[0] * $yearly_total_sales[2];

        $this->yearly_accounts_payable[0] = $this->monthly_accounts_payable[11];
        $this->yearly_accounts_payable[1] = $this->monthly_accounts_payable[0] / $yearly_total_sales[0] * $yearly_total_sales[1];
        $this->yearly_accounts_payable[2] = $this->monthly_accounts_payable[0] / $yearly_total_sales[0] * $yearly_total_sales[2];
        
        $this->yearly_cash[0] = $monthly_cash[11];

        $this->yearly_cash[1] = $this->yearly_cash[0] + $this->yearly_accounts_receivable[0] + $yearly_total_sales[1] - $this->yearly_accounts_receivable[1] + $yearly_total_loans[1] - $this->yearly_total_repayments[1] - $yearly_total_purchases[1] - $this->yearly_accounts_payable[0] - $this->yealy_total_expenses[1] + $this->yearly_accounts_payable[1] + $this->yearly_depreciation[1];

        $this->yearly_cash[2] = $this->yearly_cash[1] + $this->yearly_accounts_receivable[1] + $yearly_total_sales[2] - $this->yearly_accounts_receivable[2] + $yearly_total_loans[2] - $this->yearly_total_repayments[2] - $yearly_total_purchases[2] - $this->yearly_accounts_payable[1] - $this->yealy_total_expenses[2] + $this->yearly_accounts_payable[2] + $this->yearly_depreciation[2];

        $this->yearly_total_current_assets = [
            $this->yearly_cash[0] + $this->yearly_accounts_receivable[0],
            $this->yearly_cash[1] + $this->yearly_accounts_receivable[1],
            $this->yearly_cash[2] + $this->yearly_accounts_receivable[2]
        ];

        // calculate long term assets
        $this->yearly_long_term_assets[0] = $yearly_total_purchases[0];
        $this->yearly_long_term_assets[1] = $this->yearly_total_current_assets[0] + $yearly_total_purchases[1];
        $this->yearly_long_term_assets[2] = $this->yearly_total_current_assets[1] + $yearly_total_purchases[2];

        $this->yearly_accumulated_depreciation[0] = $this->yearly_depreciation[0] * -1;
        $this->yearly_accumulated_depreciation[1] = $this->yearly_accumulated_depreciation[0] - $this->yearly_depreciation[1];
        $this->yearly_accumulated_depreciation[2] = $this->yearly_accumulated_depreciation[1] - $this->yearly_depreciation[2];

        $this->yearly_total_long_term_assets[0] = $this->yearly_long_term_assets[0] + $this->yearly_accumulated_depreciation[0];
        $this->yearly_total_long_term_assets[1] = $this->yearly_long_term_assets[1] + $this->yearly_accumulated_depreciation[1];
        $this->yearly_total_long_term_assets[2] = $this->yearly_long_term_assets[2] + $this->yearly_accumulated_depreciation[2];

        $this->yearly_total_assets = [
            $this->yearly_total_current_assets[0] + $this->yearly_total_long_term_assets[0],
            $this->yearly_total_current_assets[1] + $this->yearly_total_long_term_assets[1],
            $this->yearly_total_current_assets[2] + $this->yearly_total_long_term_assets[2]
        ];

        $this->yearly_current_total_liabilities = $this->yearly_accounts_payable;

        $this->yearly_long_term_debt[0] = $this->monthly_total_balance[11];
        $this->yearly_long_term_debt[1] = $this->yearly_long_term_debt[0] + $yearly_total_loans[1] - $this->yearly_total_repayments[1];
        $this->yearly_long_term_debt[2] = $this->yearly_long_term_debt[1] + $yearly_total_loans[2] - $this->yearly_total_repayments[2];

        $this->yearly_total_liabilities = [
            $this->yearly_current_total_liabilities[0] + $this->yearly_long_term_debt[0],
            $this->yearly_current_total_liabilities[1] + $this->yearly_long_term_debt[1],
            $this->yearly_current_total_liabilities[2] + $this->yearly_long_term_debt[2]
        ];

        $this->yearly_paid_in_capital = [0, 0, 0];
        
        $this->yearly_earnings = $this->yearly_net_profit;
        $this->yearly_retained_earnings[0] = 0;
        $this->yearly_retained_earnings[1] = $this->yearly_retained_earnings[0] + $this->yearly_earnings[1];
        $this->yearly_retained_earnings[2] = $this->yearly_retained_earnings[1] + $this->yearly_earnings[2];
        
        $this->yearly_total_owner_equity = [
            $this->yearly_paid_in_capital[0] + $this->yearly_earnings[0] + $this->yearly_retained_earnings[0],
            $this->yearly_paid_in_capital[1] + $this->yearly_earnings[1] + $this->yearly_retained_earnings[1],
            $this->yearly_paid_in_capital[2] + $this->yearly_earnings[2] + $this->yearly_retained_earnings[2]
        ];

        $this->yearly_total_liabilities_equity = [
            $this->yearly_total_owner_equity[0] + $this->yearly_total_liabilities[0],
            $this->yearly_total_owner_equity[1] + $this->yearly_total_liabilities[1],
            $this->yearly_total_owner_equity[2] + $this->yearly_total_liabilities[2]
        ];

        $this->balance_sheet_data = [
            'cash' => $this->yearly_cash,
            'accounts_receivable' => $this->yearly_accounts_receivable,
            'total_current_assets' => $this->yearly_total_current_assets,
            'long_term_assets' => $this->yearly_long_term_assets,
            'accumulated_depreciation' => $this->yearly_accumulated_depreciation,
            'total_long_term_assets' => $this->yearly_total_long_term_assets,
            'total_assets' => $this->yearly_total_assets,
            'accounts_payable' => $this->yearly_accounts_payable,
            'current_liabilities' => $this->yearly_current_total_liabilities,
            'long_term_debt' => $this->yearly_long_term_debt,
            'total_liabilities' => $this->yearly_total_liabilities,
            'paid_in_capital' => $this->yearly_paid_in_capital,
            'retained_earnings' => $this->yearly_retained_earnings,
            'earnings' => $this->yearly_earnings,
            'total_owner_equity' => $this->yearly_total_owner_equity,
            'total_liabilities_equity' => $this->yearly_total_liabilities_equity
        ];
        
    }

    public function getMonthlyOperatingIncome()
    {
        return $this->monthly_operating_income;
    }

    public function getYearlyOperatingIncome()
    {
        return $this->yearly_operating_income;
    }

    public function getYearlyInterestIncurred()
    {
        return $this->yearly_total_interests;
    }

    public function getYearlyDepreciation()
    {
        return $this->yearly_depreciation;
    }

    public function getYearlyIncomeTax()
    {
        return $this->yearly_income_tax;
    }
    
    public function getYearlyNetProfit()
    {
        return $this->yearly_net_profit;
    }

    public function getBalanceSheetData()
    {
        return $this->balance_sheet_data ;
    }

    protected function calculateProfitAndLoss()
	{
		//Revenue 		: $this->monthlytotalsales;
		//DirectCost 	: $this->monthlytotaldirectcosts
		//Gross Margin 	: $this->monthlygrossmargin
		//Gross Margin Percentage	: $this->monthlygrossmarginpercent
		//Salary		: $this->monthlytotalsalary
		//Employee Expenses	: $this->monthlyemployeeexpenses
		//Other Expenses	: $this->monthlyexpenses
		//Total Operating Expenses : $this->monthlytotaloperatingexpenses
		//Operating Income 	: $this->monthlyoperatingIncome
		//Interest Incured 	: $this->monthlytotalinterest
		//Depreciation		: $this->monthlydepreciation
		
		//highlight_string(var_export($this->monthlyoperatingincome,true));
		
		$expenditure    = new expenditure_lib();
		// TODO: Need to confirm this default to 20% if percent is zero
		//$incomeTaxRate  =  $expenditure->incomeTaxRate > 0 ? $expenditure->incomeTaxRate : 20;
		$incomeTaxRate  =  $expenditure->incomeTaxRate;
		
		
		
		for($i=1; $i < 13; $i++) {
			$this->monthlyoperatingincome[$i] = $this->monthlygrossmargin[$i] - $this->monthlytotaloperatingexpenses[$i] ;
			
			$this->monthlypretaxprofit[$i] = $this->monthlyoperatingincome[$i] 
			- $this->monthlytotalinterest[$i] - $this->monthlydepreciation[$i];
			
			$this->monthlyincometax[$i] =  $this->monthlypretaxprofit[$i] * $incomeTaxRate/100;
			
			$this->monthlytotalexpenses[$i] = $this->monthlytotaldirectcosts[$i]
			+ $this->monthlytotaloperatingexpenses[$i]
			+ $this->monthlytotalinterest[$i]
			+ $this->monthlydepreciation[$i]
			+ $this->monthlyincometax[$i];	
			
			$this->monthlynetprofit[$i] = $this->monthlytotalsales[$i] - $this->monthlytotalexpenses[$i];
			
		}
			
		//YEARLY
		//Revenue
		//Salary			: $this->yearlytotalsalary
		//Employee Expenses	: $this->yearlyemployeeexpenses
		//Other Expenses	: $this->yearlyexpenses
		//Total Operating Expenses	: $this->yearlytotaloperatingexpenses
		//Interest Incurred	:	$this->yearlyinterest
		
		$this->yearlyrevenue[1]			= array_sum($this->monthlytotalsales);
		$this->yearlyrevenue[2]			= $this->yearlytotalsales[2];
		$this->yearlyrevenue[3]			= $this->yearlytotalsales[3];
		
		//Direct Costs		
		$this->yearlydirectcost[1]			= array_sum($this->monthlytotaldirectcosts);
		$this->yearlydirectcost[2]			= $this->yearlytotaldirectcosts[2];
		$this->yearlydirectcost[3]			= $this->yearlytotaldirectcosts[3];
		
		for($i = 1; $i < 4; $i++)
		{
			$this->yearlypfgrossmargin[$i]		= $this->yearlyrevenue[$i] - $this->yearlydirectcost[$i];
			$this->yearlypfgrossmarginpercent[$i]	= $this->yearlygrossmargin[$i]/$this->yearlyrevenue[$i];
			
			$this->yearlyoperatingincome[$i]	= $this->yearlypfgrossmargin[$i] - $this->yearlytotaloperatingexpenses[$i];
		}
		
		$this->yearlydepreciation[1] = array_sum($this->monthlydepreciation);
		
		$depreciationrate 	= 0.2;
		$taxrate 			= 0.2;
		
		for($i=2; $i < 4; $i++) {
			$sum = 0;			
			for($j=1;$j<=$i; $j++){
				$sum+= $this->yearlytotalmajorpurchases[$j];
			}
			
			$diff = 0;
			for($j=1;$j<$i; $j++){
				$diff+= $this->yearlydepreciation[$j];
			}
			
			$this->yearlydepreciation[$i] = ($sum - $diff) * $depreciationrate;
			
		}
				
		for($i = 1; $i < 4; $i++)
		{
			if ($i > 1) {
				$this->yearlypretaxprofit[$i] = $this->yearlyoperatingincome[$i]
				+ $this->yearlyinterest[$i] + $this->yearlydepreciation[$i];
			} else {
				$this->yearlypretaxprofit[$i] = $this->yearlyoperatingincome[$i]
				- $this->yearlyinterest[$i] - $this->yearlydepreciation[$i];
			}
			
			
			$this->yearlyincometax[$i] 		= $this->yearlypretaxprofit[$i] * $taxrate;
			
			$this->yearlytotalexpenses[$i]	= $this->yearlydirectcost[$i]
			+ $this->yearlytotaloperatingexpenses[$i] + $this->yearlyinterest[$i]
			+ $this->yearlydepreciation[$i] + $this->yearlyincometax[$i];
			
			$this->yearlynetprofit[$i]	= $this->yearlyrevenue[$i] - $this->yearlytotalexpenses[$i];
			$this->yearlynetprofitpercent[$i]	= $this->yearlynetprofit[$i]/$this->yearlyrevenue[$i]*100;
		}
	}

	
	
    protected function renderLoans()
	{

		$_loanInvestment 				= new loansInvestments_lib();
		$allloanInvestmentProjection 	= $_loanInvestment->getAllCashProjections("NOT (loan_investment.type_of_funding = 'Investment') ", "", "");
		
		$loans		= $allloanInvestmentProjection;		
		$counter 	= 1;
		
		
		
		foreach($loans as $loan){
			$this->monthlyloans[$counter]			= array();
			$this->monthlyloans[$counter]['name'] 	= $loan['loan_invest_name'];
			
			for($i=1;$i<13;$i++) {
				$index 				= str_pad($i, 2, "0", STR_PAD_LEFT);
				$this->monthlyloans[$counter][$i]	= floatval($loan['limr_month_' . $index]);	

				if(isset($this->monthlytotalamountreceive[$i])) {
					$this->monthlytotalamountreceive[$i] += floatval($loan['limr_month_' . $index]);
				} else {
					$this->monthlytotalamountreceive[$i] = floatval($loan['limr_month_' . $index]);
				}
								
				
			}
			
			$this->monthlyloans[$counter]['interestrate'] = floatval($loan['loan_invest_interest_rate']);
			$this->monthlyloans[$counter]['period'] = floatval($loan['loan_invest_pays_per_years']);
			$this->monthlyloans[$counter]['terms'] = floatval($loan['loan_invest_years_to_pay']);
			
			$counter++;
		}
		
		//highlight_string(var_export($allloanInvestmentProjection,true));
		
		
		
		$counter = 1;
		
		foreach($this->monthlyloans as $loan) {
			
			$interestrate = $loan['interestrate']/100;

			//$period	= 12;
			//$terms	= 3; //3 years
			//$pmtperiod = $period*$terms;
			
			$period	= $loan['period'];
			$terms	= $loan['terms'];
			$pmtperiod = $period*$terms;
			
			
			//echo "interest rate: " . $interestrate;
			
			//$this->monthlyrepayments[0]			= 0;
			//$this->monthlytotalamountrepaid[0]	= 0; //estimated repayment
			//$this->monthlyestimatedbalance[0]	= 0;
			
			//monthly repayment
			$this->monthlyestimatedbalance[$counter] 	= array($loan['name']);
			$this->monthlyestimatedinterest[$counter] 	= array($loan['name']);
			$this->monthlyrepayments[$counter]	= array($loan['name']);
			
						
			for($i=1;$i<13;$i++) {
				
				$tmpsum = 0;

				if($i!=1) {
					for($j = 1; $j <= $i; $j++){
						$tmpsum  += $loan[$j];
					}	
				} else {
					$tmpsum = $loan[$i];
				}
				
			
				if($i==1){
					$this->monthlyrepayments[$counter][$i] = 0;
				} elseif($this->monthlyestimatedbalance[$counter][$i-1] == 0) {
					$this->monthlyrepayments[$counter][$i] = 0;
				} elseif($tmpsum == 0) {
					$this->monthlyrepayments[$counter][$i] = 0;									
				} else {
					$this->monthlyrepayments[$counter][$i] = -self::PMT($interestrate/$period, $pmtperiod, $tmpsum);
				}
				
				//monthly estimated interest
				if($i==1){
					$this->monthlyestimatedinterest[$counter][$i] = 0;
				} elseif($this->monthlyestimatedbalance[$counter][$i-1] == 0) {
					$this->monthlyestimatedinterest[$counter][$i] = 0;				
				} else {
					$this->monthlyestimatedinterest[$counter][$i] = -self::IPMT($interestrate/$period, 1, $pmtperiod, $tmpsum);
				}
								
				
				$this->monthlyestimatedbalance[$counter][$i] = $this->monthlyestimatedbalance[$counter][$i-1] + $loan[$i] 
				- $this->monthlyrepayments[$counter][$i] 
				+ $this->monthlyestimatedinterest[$counter][$i];
				
				if(isset($this->monthlytotalamountrepaid[$i])) {
					$this->monthlytotalamountrepaid[$i]	+= $this->monthlyrepayments[$counter][$i];
					$this->monthlytotalbalance[$i]		+= $this->monthlyestimatedbalance[$counter][$i];
					$this->monthlytotalinterest[$i]		+= $this->monthlyestimatedinterest[$counter][$i];
				} else {
					$this->monthlytotalamountrepaid[$i]	= $this->monthlyrepayments[$counter][$i];
					$this->monthlytotalbalance[$i]		= $this->monthlyestimatedbalance[$counter][$i];
					$this->monthlytotalinterest[$i]		= $this->monthlyestimatedinterest[$counter][$i];
				}
				
			}
			
			$counter++;
		}
			
		//yearly
		
		
		$counter = 1;
		
		foreach($loans as $loan) {
			
			$this->yearlyloans[$counter] = array($loan['loan_invest_name']);
						
			for($i=1;$i<4;$i++) {
				
				$tmp = $loan['financial_receive'][$i-1];
				$this->yearlyloans[$counter][$i] = floatval($tmp['lir_total_per_yr']);
				
				$tmp = $loan['financial_payment'][$i-1];
				$this->yearlyamountrepaid[$i] 	= floatval($tmp['lip_total_per_yr']);
				
				
				if(isset($this->yearlytotalloans[$i]))
				{
					$this->yearlytotalloans[$i] += $this->yearlyloans[$counter][$i];
				}else {
					$this->yearlytotalloans[$i] = $this->yearlyloans[$counter][$i];
				}
			}						
			
			$counter++;
		}
		
		//hardcoded yearlyamountreceive pjj1 there is no advance loan yet as of 10may2014
		
		
		$this->yearlyamountreceive		= array(1=>0,2=>0,3=>0);//$this->yearlytotalloans;   	
		$this->yearlyinterest[1]		= array_sum($this->monthlytotalinterest);
		$this->yearlyrepayments[1]		= array_sum($this->monthlytotalamountrepaid);
		
		$tmpsum = $this->yearlyamountreceive[1] - $this->yearlyrepayments[1] + $this->yearlyinterest[1] + $this->yearlyamountreceive[2]; 
		
		if($tmpsum < 0 ) {
			$this->yearlyrepayments[2]		= 0;			
		} else {
			$this->yearlyrepayments[2]		= $this->yearlyrepayments[1];
		}
		
		$this->yearlyinterest[2]			= $this->yearlyinterest[1];
		$this->yearlyinterest[3]			= $this->yearlyinterest[2];
		
		$tmpsum = $tmpsum-$this->yearlyrepayments[2] + $this->yearlyinterest[2];
		
		if($tmpsum < 0 ) {
			$this->yearlyrepayments[3]		= 0;
		} else {
			$this->yearlyrepayments[3]		= $this->yearlyrepayments[2];
		}
		
		//highlight_string(var_export($loans,true));
		
		
		
	}
	
	
	protected function renderInvestments()
	{
	
		$_loanInvestment 				= new loansInvestments_lib();
		$allloanInvestmentProjection 	= $_loanInvestment->getAllCashProjections("(loan_investment.type_of_funding = 'Investment') ", "", "");
	
		$loans		= $allloanInvestmentProjection;
		$counter 	= 1;
	
	
	
		foreach($loans as $loan){
			$this->monthlyinvestments[$counter]			= array();
			$this->monthlyinvestments[$counter]['name'] 	= $loan['loan_invest_name'];
			$this->monthlyinvestmentsrepaid[$counter]['name'] = $loan['loan_invest_name'];
				
			for($i=1;$i<13;$i++) {
				$index 				= str_pad($i, 2, "0", STR_PAD_LEFT);
				$this->monthlyinvestments[$counter][$i]	= floatval($loan['limr_month_' . $index]);
				$this->monthlyinvestmentsrepaid[$counter][$i]	= floatval($loan['limp_month_' . $index]);
				
				if(isset($this->monthlytotalinvestmentsamountreceive[$i])) {
					$this->monthlytotalinvestmentsamountreceive[$i] += floatval($loan['limr_month_' . $index]);
				} else {
					$this->monthlytotalinvestmentsamountreceive[$i] = floatval($loan['limr_month_' . $index]);
				}
				
				if(isset($this->monthlytotalinvestmentsamountrepaid[$i])) {
					$this->monthlytotalinvestmentsamountrepaid[$i] += floatval($loan['limp_month_' . $index]);
				} else {
					$this->monthlytotalinvestmentsamountrepaid[$i] = floatval($loan['limp_month_' . $index]);
				}	
	
			}
				
			//$this->monthlyinvestments[$counter]['interestrate'] = floatval($loan['loan_invest_interest_rate']);
			//$this->monthlyinvestments[$counter]['period'] = floatval($loan['loan_invest_pays_per_years']);
			//$this->monthlyinvestments[$counter]['terms'] = floatval($loan['loan_invest_years_to_pay']);
				
			$counter++;
		}
	
		//highlight_string(var_export($this->monthlyinvestmentsrepaid,true));
	
	
		
			
		//yearly
	
	
		$counter = 1;
	
		foreach($loans as $loan) {
				
			$this->yearlyinvestment[$counter] = array($loan['loan_invest_name']);
	
			for($i=1;$i<4;$i++) {
	
				if($i>1) {
					$tmp = $loan['financial_receive'][$i-1];
					//NOTE: there is something wrong with the spreadsheet, it wont balance if the value is picked up from lir_total_per_yr
					$this->yearlyinvestment[$counter][$i] = 0; //floatval($tmp['lir_total_per_yr']);
										
				} else {
					
					$tmpr = $this->monthlyinvestments[$counter];
					unset($tmpr['name']);								
					
					$tmpp = $this->monthlyinvestmentsrepaid[$counter];
					unset($tmpp['name']);										
					
					$this->yearlyinvestment[$counter][$i] = floatval(array_sum($tmpr) - array_sum($tmpp));
				}
				
	
	
				if(isset($this->yearlytotalinvestment[$i]))
				{
					$this->yearlytotalinvestment[$i] += $this->yearlyinvestment[$counter][$i];
				}else {
					$this->yearlytotalinvestment[$i] = $this->yearlyinvestment[$counter][$i];
				}
			}
				
			$counter++;
		}
	
		for($i=1;$i<4;$i++) {
			
			if ($i > 1) {
				$this->yearlynetinvestment[$i] = $this->yearlynetinvestment[$i-1] + $this->yearlytotalinvestment[$i];
			} else {
				$this->yearlynetinvestment[$i] = $this->yearlytotalinvestment[$i];
			}
			
		}
	
		//highlight_string(var_export($loans,true));
	
	
	
	}
	
	
	
	
	
	protected function renderAccountsReceivable(){
		//Total Sales	: $this->monthlytotalsales
		$cashsettinglib = new cashFlowProjection_lib();
		
		if(isset($_SESSION['bpId']))
		{
			$businessPlanId = $_SESSION['bpId'];
			$cashsetting 	= $cashsettinglib->Payments($businessPlanId);
			if (count($cashsetting)) {
				$cashsetting = $cashsetting[0];
			}
		}
		
		
		
		//echo highlight_string(var_export($cashsetting, TRUE));
		
		
		$percentoncredit 	= $cashsetting['percentage_sale']/100;
		$daystocollect		= $cashsetting['days_collect_payments'];
		
		//echo highlight_string(var_export($monthlytotalsales, TRUE));
		
		$collectpercent = array();
		$collectdays	= array();
		
		for($i = 0; $i < 20; $i++) {
			$collectpercent[] 	= ($i * 5)/100;
			$collectdays[]		= ($i * 30);
		}
		
		$cashcollected 		= array();
		$cashcollected[0] 	= array();
		
		$tmprow 						= $cashcollected[0];
		$MonthlyAccountsReceivable 		= array();
		$MonthlyAccountsReceivable[-1] 	= 0;
		$TotalAccountsReceivable		= array();
		$TotalAccountsReceivable[-1]	= 0;
		
		//echo highlight_string(var_export($monthlytotalsales, TRUE));
		
		
		
		for($j = 0; $j<12 ; $j++) {
			if ($percentoncredit < 0 || $percentoncredit == 0 ) {
				$tmprow[$j] = $this->monthlytotalsales[$j+1];
			} else {
				$tmprow[$j] = $this->monthlytotalsales[$j+1]*(1-$percentoncredit);
			}
		
		}
		$cashcollected[0]		= $tmprow;
		$cashcollectedcurrent 	= $tmprow;
		
		
		
		
		$totalcashcollected = array();
		
		for($i = 1; $i < 13; $i++) {
		
			$cashcollected[$i] 	= array();
		
			for ($j = 0; $j < $i; $j++ ) {
				$cashcollected[$i][$j] = 0;
				if(isset($totalcashcollected[$i-1])){
					$totalcashcollected[$i-1] += $cashcollected[$i-1][$j];
				} else {
					$totalcashcollected[$i-1] = $cashcollected[$i-1][$j];
				}
		
			}
		
			if ($i > 1 ) {
				$totalcashcollected[$i-1] += $cashcollected[0][$i-1];
			}
		
			//$totalcashcollected[$i-1] += $cashcollected[0][$i-1];
		
			$MonthlyAccountsReceivable[$i-1] 	= $this->monthlytotalsales[$i] - $cashcollectedcurrent[$i-1];
			$TotalAccountsReceivable[$i-1]		= $TotalAccountsReceivable[$i-2] + $this->monthlytotalsales[$i] - $totalcashcollected[$i-1];
		
		
			for($j = 0; $j < 12; $j++ ){
				if($j<$i) {
					$cashcollected[$i][$j] = 0;
				} else {
					$cashcollected[$i][$j] = ( $daystocollect == $collectdays[$j-$i+1] ? $MonthlyAccountsReceivable[$i-1] : 0 );
				}
			}
		
				
				
		}
		
		$cashcollectedreceivable = array();
		
		for($i = 0; $i < 13; $i++) {
			for($j = 0; $j < 12; $j++) {
				if(isset($cashcollectedreceivable[$j+1])) {
					$cashcollectedreceivable[$j+1] += $cashcollected[$i][$j];
				} else {
					$cashcollectedreceivable[$j+1] = $cashcollected[$i][$j];
				}
					
			}
		}
		
			
		
		$TotalAccountsReceivable = array_slice($TotalAccountsReceivable,1);
		
		//$cashcollectedreceivable 		= $cashcollected;
		$totalcashcollectedreceivable 	= $cashcollectedreceivable;
		
		
		$this->monthlyreceivabletotalcashcollected = $totalcashcollectedreceivable;
		
		$tmp = array();
		for($i = 1; $i < 13; $i++) {
			$tmp[$i] = $TotalAccountsReceivable[$i-1];
		}
		
		for($i = 1; $i < 13; $i++) {
			if($i > 1) {
				$tmp[$i] = $this->monthlytotalsales[$i] + $tmp[$i-1] - $totalcashcollectedreceivable[$i];
			} else {
				$tmp[$i] = $this->monthlytotalsales[$i] - $totalcashcollectedreceivable[$i];
			}
		}
		
		
		$TotalAccountsReceivable = $tmp;
		
		$MonthlyAccountsReceivable = array_slice($MonthlyAccountsReceivable,1);
		
		$this->truemonthlyaccountsreceivable = $MonthlyAccountsReceivable;
		
		
		$this->monthlyaccountsreceivable = $tmp;
		
				
		
		/*
		 echo highlight_string(var_export($this->monthlytotalsales, TRUE));
		echo highlight_string(var_export($TotalAccountsReceivable, TRUE));
		echo "totalcashcollected receivable:<br>";
		echo highlight_string(var_export($totalcashcollectedreceivable, TRUE));
		echo highlight_string(var_export($tmp1, TRUE));
		*/
		//Calculate monthly payable
		$percentoncredit 	= $cashsetting['percentage_purchase']/100;
		$daystocollect		= $cashsetting['days_make_payments'];
		
		$tmptotalDirectCost	= $this->monthlytotaldirectcosts;
		
		$monthlytotalsalary			= $this->monthlytotalsalary;
		$monthlytotalrelatedexpenses= $this->monthlyemployeeexpenses;
		$monthlytotalexpenses		= $this->monthlytotaloperatingexpenses;
		
		$totalExpenses = array();
		
		for($j = 1; $j < 13; $j++ ){
			$totalExpenses[] = $tmptotalDirectCost[$j] + $monthlytotalexpenses[$j] - $monthlytotalsalary[$j] - $monthlytotalrelatedexpenses[$j];
		}
		
		
		
		
		
		$cashcollected 		= array();
		$cashcollected[0] 	= array();
		
		$tmprow 						= $cashcollected[0];
		$MonthlyAccountsPayable 		= array();
		$MonthlyAccountsPayable[-1] 	= 0;
		$TotalAccountsPayable			= array();
		$TotalAccountsPayable[-1]		= 0;
		
		
		
		for($j = 0; $j<12 ; $j++) {
			if ($percentoncredit < 0 || $percentoncredit == 0 ) {
				$tmprow[$j] = $totalExpenses[$j];
			} else {
				$tmprow[$j] = $totalExpenses[$j] * (1-$percentoncredit);
			}
		
		}
		
		
		
		
		
		$cashcollected[0]		= $tmprow;
		$cashcollectedcurrent 	= $tmprow;
		
				
		$totalcashcollected = array();
		
		for($i = 1; $i < 13; $i++) {
		
			$cashcollected[$i] 	= array();
		
			for ($j = 0; $j < $i; $j++ ) {
				$cashcollected[$i][$j] = 0;
				if(isset($totalcashcollected[$i-1])){
					$totalcashcollected[$i-1] += $cashcollected[$i-1][$j];
				} else {
					$totalcashcollected[$i-1] = $cashcollected[$i-1][$j];
				}
		
			}
		
			if ($i > 1 ) {
				$totalcashcollected[$i-1] += $cashcollected[0][$i-1];
			}
		
			$MonthlyAccountsPayable[$i-1] 	= $totalExpenses[$i-1] - $cashcollectedcurrent[$i-1];
			$TotalAccountsPayable[$i-1]		= $TotalAccountsPayable[$i-2] + $totalExpenses[$i-1] - $totalcashcollected[$i-1];
		
		
			for($j = 0; $j < 12; $j++ ){
				if($j<$i) {
					$cashcollected[$i][$j] = 0;
				} else {
					$cashcollected[$i][$j] = ( $daystocollect == $collectdays[$j-$i+1] ? $MonthlyAccountsPayable[$i-1] : 0 );
				}
			}
		
			
				
		}
		
		
		$cashcollectedpayable = array();
		
		for($i = 0; $i < 13; $i++) {
			for($j = 0; $j < 12; $j++) {
				if(isset($cashcollectedpayable[$j+1])) {
					$cashcollectedpayable[$j+1] += $cashcollected[$i][$j];
				} else {
					$cashcollectedpayable[$j+1] = $cashcollected[$i][$j];
				}
					
			}
		}
		
		
		$totalcashcollectedpayable = $cashcollectedpayable;
		
		
		$MonthlyAccountsPayable = array_slice($MonthlyAccountsPayable,1);
		$TotalAccountsPayable = array_slice($TotalAccountsPayable,1);
		
		
		$tmp = array();
		for($i = 1; $i < 13; $i++) {
			$tmp[$i] = $MonthlyAccountsPayable[$i-1];
		}
		
		$MonthlyAccountsPayable = $tmp;
		
		
		//$this->monthlyaccountspayable = $totalcashcollectedpayable;
		
		$tmp = array();
		for($i = 1; $i < 13; $i++) {
			$tmp[$i] = $TotalAccountsPayable[$i-1];
		}
		
		for($i = 1; $i < 13; $i++) {
			if($i > 1) {
				$tmp[$i] = $totalExpenses[$i-1] + $tmp[$i-1] - $totalcashcollectedpayable[$i];
			} else {
				$tmp[$i] = $totalExpenses[$i-1] - $totalcashcollectedpayable[$i];
			}
		}
		
		
		
		
		
		$this->monthlypayabletotalcashcollected = $totalcashcollectedpayable;
		
		$this->monthlyaccountspayable = $tmp;
		
		//highlight_string(var_export($this->monthlyaccountspayable, TRUE));
		
		
		
		//calculate monthly cash
		$monthlycash = array();
		
		$incometax = $this->monthlyincometax;
		$monthlypurchase = $this->monthlytotalmajorpurchases;
		$monthlyreceive = $this->monthlytotalamountreceive;
		$monthlypayment	= $this->monthlytotalamountrepaid;
		$monthylyinterestincurred = $this->monthlytotalinterest;
		
		$monthlytotalinterest	= $this->monthlytotalinterest;
		$monthlydepreciation	= $this->monthlydepreciation;
		
		$monthlyiamountreceive = $this->monthlytotalinvestmentsamountreceive;
		$monthlyiamountrepaid  =  $this->monthlytotalinvestmentsamountrepaid;
		
		$monthlycash[0] = 0;
		
		for($i = 0; $i < 12; $i++) {
		
			if ($i>0) {
				$monthlycash[$i] = $monthlycash[$i-1];
			}
			/*
			 $monthlycash[$i] = $monthlycash[$i] + $monthlyreceive[$i+1] - $monthlypayment[$i+1] + $totalcashcollectedreceivable[$i];
			- $totalcashcollectedpayable[$i] - $monthlytotalsalary[$i+1] - $monthlytotalrelatedexpenses[$i+1];
			- $monthylyinterestincurred[$i+1] - $monthlypurchase[$i+1] - $incometax[$i+1];
			*/
		
			$monthlycash[$i] = $monthlycash[$i] + $monthlyreceive[$i+1] - $monthlypayment[$i+1]
			+ $monthlytotalinterest[$i+1] + $totalcashcollectedreceivable[$i+1]
			- $totalcashcollectedpayable[$i+1] - $monthlytotalsalary[$i+1] - $monthlytotalrelatedexpenses[$i+1]
			- $monthylyinterestincurred[$i+1] - $monthlydepreciation[$i+1] - $incometax[$i+1]
			- $monthlypurchase[$i+1] + $monthlydepreciation[$i+1]
			+ $monthlyiamountreceive[$i+1] - $monthlyiamountrepaid[$i+1];
		
		}
		
		$tmp = array();
		for($i = 1; $i < 13; $i++) {
			$tmp[$i] = $monthlycash[$i-1];
		}
		
		$this->monthlycash = $tmp;
		
		//highlight_string(var_export($monthlycash, TRUE));
		
		/*
		 echo '<br>monthlyreceive: ';
		echo highlight_string(var_export($monthlyreceive, TRUE));
		echo '<br>$monthlypayment: ';
		echo highlight_string(var_export($monthlypayment, TRUE));
		echo '<br>$totalcashcollectedreceivable: ';
		echo highlight_string(var_export($totalcashcollectedreceivable, TRUE));
		echo '<br>$totalcashcollectedpayable: ';
		echo highlight_string(var_export($totalcashcollectedpayable, TRUE));
		echo '<br>$monthlytotalsalary: ';
		echo highlight_string(var_export($monthlytotalsalary, TRUE));
		echo '<br>$monthlytotalrelatedexpenses: ';
		echo highlight_string(var_export($monthlytotalrelatedexpenses, TRUE));
		echo '<br>$monthylyinterestincurred: ';
		echo highlight_string(var_export($monthylyinterestincurred, TRUE));
		echo '<br>$monthlypurchase: ';
		echo highlight_string(var_export($monthlypurchase, TRUE));
		echo '<br>$incometax: ';
		echo highlight_string(var_export($incometax, TRUE));
		
		*/
		
		
		
		
	}
	
	
	protected function renderBalanceSheet() {
		//Cash 					: $this->monthlycash
		//Accounts Receivable	: $this->monthlyaccountsreceivable
		
		//Accumulated Depreciation 	: $this->monthlyaccudepreciation
		//Monthly Accounts payable	: $this->monthlyaccountspayable	
		//Long-Term Debt			: $this->monthlytotalbalance
		//Earnings				: $this->monthlynetprofit
		
		$totalcurrentassets 	= array();
		$totalcurrentliability	= array();
		
		
		$balMonthlyRetainedEarnings 	= array();
		
		for ($i = 1; $i < 13; $i++ ) {
			
						
			if(isset($this->monthlynetprofit[$i-1])) {
				$balMonthlyRetainedEarnings[$i] = $balMonthlyRetainedEarnings[$i-1] + $this->monthlynetprofit[$i-1];
			} else {
				$balMonthlyRetainedEarnings[$i] = 0;
			}

			if ($i > 1) {
				$this->monthlypaidincapital[$i] = $this->monthlypaidincapital[$i-1] 
				+ $this->monthlytotalinvestmentsamountreceive[$i] - $this->monthlytotalinvestmentsamountrepaid[$i];
			} else {
				$this->monthlypaidincapital[$i] = $this->monthlytotalinvestmentsamountreceive[$i] - $this->monthlytotalinvestmentsamountrepaid[$i];
			}
			
		}
		
		$this->monthlyretainedearnings = $balMonthlyRetainedEarnings;
		
		$acculongtermsassets = array();
		
		for($i = 1; $i < 13; $i++) {
			
			if($i!=1) {
				$acculongtermsassets[$i] = $acculongtermsassets[$i-1] +  $this->monthlytotalmajorpurchases[$i];
			} else {
				$acculongtermsassets[$i] = $this->monthlytotalmajorpurchases[$i];
			}
				
			
			$totalcurrentassets[$i] = $this->monthlycash[$i]+$this->monthlyaccountsreceivable[$i];
			
			$this->monthlytotallongtermassets[$i] = $acculongtermsassets[$i] + $this->monthlyaccudepreciation[$i];
			
			$this->monthlytotalassets[$i] = $totalcurrentassets[$i] + $this->monthlytotallongtermassets[$i];
			
			$this->monthlytotalliability[$i] = $this->monthlyaccountspayable[$i] + $this->monthlytotalbalance[$i];
			
			$this->monthlyownerequity[$i] = $this->monthlypaidincapital[$i] + $balMonthlyRetainedEarnings[$i] + $this->monthlynetprofit[$i];
			
			$this->monthlyliabilityandequity[$i] = $this->monthlytotalliability[$i] + $this->monthlyownerequity[$i];

			
			
		}
		
		$this->monthlylongtermassets	=  $acculongtermsassets;
		$this->monthlytotalcurrentassets = $totalcurrentassets;
		

		//YEARLY
		
		$this->yearlycash[1]				= $this->monthlycash[12];
		$this->yearlyaccountsreceivable[1] 	= $this->monthlyaccountsreceivable[12];
		$this->yearlyaccountsreceivable[2]	= $this->yearlyaccountsreceivable[1]/$this->yearlytotalsales[1]*$this->yearlytotalsales[2];
		$this->yearlyaccountsreceivable[3]	= $this->yearlyaccountsreceivable[1]/$this->yearlytotalsales[1]*$this->yearlytotalsales[3];
		
		$this->yearlyaccountspayable[1] 	= $this->monthlyaccountspayable[12];
		$this->yearlyaccountspayable[2]		= $this->yearlyaccountspayable[1]/$this->yearlytotaldirectcosts[1]*$this->yearlytotaldirectcosts[2];
		$this->yearlyaccountspayable[3]		= $this->yearlyaccountspayable[1]/$this->yearlytotaldirectcosts[1]*$this->yearlytotaldirectcosts[3];
		
		
		$this->yearlycash[2]				= $this->yearlycash[1] + $this->yearlyaccountsreceivable[1] + $this->yearlyrevenue[2]
		- $this->yearlyaccountsreceivable[2] + $this->yearlyamountreceive[2] - $this->yearlyrepayments[2]
		- $this->yearlytotalmajorpurchases[2] - $this->yearlyaccountspayable[1] - $this->yearlytotalexpenses[2] 
		+ $this->yearlyaccountspayable[2] + $this->yearlydepreciation[2];
		
		$this->yearlycash[3]				= $this->yearlycash[2] + $this->yearlyaccountsreceivable[2] + $this->yearlyrevenue[3]
		- $this->yearlyaccountsreceivable[3] + $this->yearlyamountreceive[3] - $this->yearlyrepayments[3]
		- $this->yearlytotalmajorpurchases[3] - $this->yearlyaccountspayable[2] - $this->yearlytotalexpenses[3]
		+ $this->yearlyaccountspayable[3] + $this->yearlydepreciation[3];
		
		for($i=1; $i < 4; $i ++) {
			$this->yearlytotalcurrentassets[$i] = $this->yearlycash[$i] + $this->yearlyaccountsreceivable[$i];
		}
		
		$this->yearlylongtermassets[1] = $this->monthlylongtermassets[12];
		$this->yearlylongtermassets[2] = $this->yearlylongtermassets[1] + $this->yearlytotalmajorpurchases[2];
		$this->yearlylongtermassets[3] = $this->yearlylongtermassets[2] + $this->yearlytotalmajorpurchases[3];
		
		$this->yearlyaccudepreciation[1]		= $this->monthlyaccudepreciation[12];
		$this->yearlyaccudepreciation[2]		= $this->yearlyaccudepreciation[1] -  $this->yearlydepreciation[2];
		$this->yearlyaccudepreciation[3]		= -$this->yearlydepreciation[1] - $this->yearlydepreciation[2] - $this->yearlydepreciation[3];
		
		for($i=1; $i < 4; $i++) {
			$this->yearlytotallongtermassets[$i] 	= $this->yearlylongtermassets[$i] + $this->yearlyaccudepreciation[$i];			
			$this->yearlytotalassets[$i]			= $this->yearlytotalcurrentassets[$i] + $this->yearlytotallongtermassets[$i];
		}
		
		
		/*
		public $yearlycash					= array();
		public $yearlyaccountsreceivable	= array();
		public $yearlytotalcurrentassets	= array();
		public $yearlylongtermassets		= array();
		public $yearlyaccudepreciation		= array()
		public $yearlytotallongtermassets	= array();
		public $yearlytotalassets			= array();
		*/
		
		$this->yearlytotalcurrentliabilities	= $this->yearlyaccountspayable; //sales tax payable is zero, short term debt is zero 
		
		//NOTE: monthlylongterdebt is $this->monthlytotalbalance
		
		$this->yearlylongtermdebt[1]			= $this->monthlytotalbalance[12];
		$this->yearlylongtermdebt[2]			= $this->yearlylongtermdebt[1] + $this->yearlytotalloans[2] - $this->yearlyrepayments[2];
		$this->yearlylongtermdebt[3]			= $this->yearlylongtermdebt[2] + $this->yearlytotalloans[3] - $this->yearlyrepayments[3];
		
		for($i=1; $i < 4; $i++) {
			$this->yearlytotalliabilities[$i]	= $this->yearlytotalcurrentliabilities[$i] + $this->yearlylongtermdebt[$i];			
		}
		
		//monthlyearnings				: $this->monthlynetprofit
		
		$this->yearlyearnings[1]			= $this->monthlynetprofit[12] + $this->monthlyretainedearnings[12];
		$this->yearlyearnings[2]			= $this->yearlynetprofit[2];
		$this->yearlyearnings[3]			= $this->yearlynetprofit[3];
		
		$this->yearlyretainedearnings[1]	= 0;
		$this->yearlyretainedearnings[2]	= $this->yearlyretainedearnings[1] + $this->yearlyearnings[1];
		$this->yearlyretainedearnings[3]	= $this->yearlyretainedearnings[2] + $this->yearlyearnings[2];
		
		for($i=1; $i < 4; $i++) {
			$this->yearlytotalownerequity[$i]	= $this->yearlynetinvestment[$i] + $this->yearlyretainedearnings[$i] + $this->yearlyearnings[$i];
			$this->yearlytotalliabilityandEquity[$i] = $this->yearlytotalliabilities[$i] + $this->yearlytotalownerequity[$i];
		}
		 
		
		/*
		public $yearlyaccountspayable		= array();
		public $yearlytotalcurrentliabilities	= array();
		public $yearlylongtermdebt			= array();
		public $yearlytotalliabilities		= array();
		public $yearlyretainedearnings		= array();
		public $yearlyearnings				= array();
		public $yearlytotalownerequity		= array();
		public $yearlytotalliabilityandEquity	= array();
		*/
		
	}
	
	protected function renderCashFlow() {
		//NET PROFIT			: $this->monthlynetprofit
		//Depreciation			: $this->monthlydepreciation
		
		
		
		$this->cashatbeginningofperiod[1] = 0;
		
		for($i=1; $i < 13; $i++) {
			
			if($i>1) {
				$this->changeinaccountsreceivable[$i]	= $this->monthlyaccountsreceivable[$i-1] - $this->monthlyaccountsreceivable[$i];
				$this->changeinaccountspayable[$i]		= $this->monthlyaccountspayable[$i]- $this->monthlyaccountspayable[$i-1];
				$this->changeinlongtermdebt[$i]			= $this->monthlytotalbalance[$i]-$this->monthlytotalbalance[$i-1];
				
			} else {
				$this->changeinaccountsreceivable[$i] 	= -$this->monthlyaccountsreceivable[$i];
				$this->changeinaccountspayable[$i]		= $this->monthlyaccountspayable[$i];
				$this->changeinlongtermdebt[$i]			= $this->monthlytotalbalance[$i];
			}
			
			
			$this->netcashflowfromoperations[$i] = $this->monthlynetprofit[$i]
			+ $this->monthlydepreciation[$i]
			+ $this->changeinaccountsreceivable[$i]
			+ $this->changeinaccountspayable[$i];

			//Assets purchase or sold		: -$this->monthlytotalmajorpurchases;
			
			$this->assetspurchasedorsold[$i]		= -$this->monthlytotalmajorpurchases[$i];
			
			$this->netcashflowfrominvesting[$i] = $this->assetspurchasedorsold[$i]
			+ $this->changeinlongtermdebt[$i];

			
			$this->netchangeincash[$i]			= $this->netcashflowfromoperations[$i]
			+ $this->netcashflowfrominvesting[$i];
			
			if ($i > 1) {
				$this->cashatbeginningofperiod[$i] = $this->cashatendofperiod[$i-1];
			}
			
			$this->cashatendofperiod[$i]		= $this->cashatbeginningofperiod[$i]
			+ $this->netchangeincash[$i];
			
		}
		 
		//YEARLY
		//NETPROFIT				:	$this->yearlynetprofit;
		//Depreciation			:	$this->yearlydepreciation
		
		$this->yearlycashatbeginningofperiod[1] = 0;
		
		for($i=1; $i < 4; $i++) {
			
			if($i>1) {
				$this->yearlychangeinaccountsreceivable[$i] = $this->yearlyaccountsreceivable[$i-1] - $this->yearlyaccountsreceivable[$i];
				$this->yearlychangeinaccountspayable[$i]	= $this->yearlyaccountspayable[$i] - $this->yearlyaccountspayable[$i-1];
				$this->yearlychangeinlongtermdebt[$i]		= $this->yearlylongtermdebt[$i]-$this->yearlylongtermdebt[$i-1];
			} else {
				$this->yearlychangeinaccountsreceivable[$i] = -$this->yearlyaccountsreceivable[$i];
				$this->yearlychangeinaccountspayable[$i]	= $this->yearlyaccountspayable[$i];
				$this->yearlychangeinlongtermdebt[$i]		= $this->yearlylongtermdebt[$i];
			}			
			
			$this->yearlynetcashflowfromoperations[$i] = $this->yearlynetprofit[$i]
			+ $this->yearlydepreciation[$i]
			+ $this->yearlychangeinaccountsreceivable[$i]
			+ $this->yearlychangeinaccountspayable[$i];
			
			//Assets purchase or sold		: -$this->monthlytotalmajorpurchases;
				
			$this->yearlyassetspurchasedorsold[$i]		= -$this->yearlytotalmajorpurchases[$i];
			
			$this->yearlynetcashflowfrominvesting[$i] = $this->yearlyassetspurchasedorsold[$i]
			+ $this->yearlychangeinlongtermdebt[$i];
			
			$this->yearlynetchangeincash[$i]			= $this->yearlynetcashflowfromoperations[$i]
			+ $this->yearlynetcashflowfrominvesting[$i];
			
			if ($i > 1) {
				$this->yearlycashatbeginningofperiod[$i] = $this->yearlycashatendofperiod[$i-1];
			}
				
			$this->yearlycashatendofperiod[$i]		= $this->yearlycashatbeginningofperiod[$i]
			+ $this->yearlynetchangeincash[$i];
			
			
		}
		
	}
	
	private static function _interestAndPrincipal($rate=0, $per=0, $nper=0, $pv=0, $fv=0, $type=0) {
		$pmt = self::PMT($rate, $nper, $pv, $fv, $type);
		$capital = $pv;
		for ($i = 1; $i<= $per; ++$i) {
			$interest = ($type && $i == 1)? 0 : -$capital * $rate;
			$principal = $pmt - $interest;
			$capital += $principal;
		}
		return array($interest, $principal);
	}	//	function _interestAndPrincipal()
	
	public static function IPMT($rate, $per, $nper, $pv, $fv = 0, $type = 0) {
		$rate	= self::flattenSingleValue($rate);
		$per	= (int) self::flattenSingleValue($per);
		$nper	= (int) self::flattenSingleValue($nper);
		$pv		= self::flattenSingleValue($pv);
		$fv		= self::flattenSingleValue($fv);
		$type	= (int) self::flattenSingleValue($type);
	
		// Validate parameters
		if ($type != 0 && $type != 1) {
			return self::$_errorCodes['num'];
		}
		if ($per <= 0 || $per > $nper) {
			return self::$_errorCodes['value'];
		}
	
		// Calculate
		$interestAndPrincipal = self::_interestAndPrincipal($rate, $per, $nper, $pv, $fv, $type);
		return $interestAndPrincipal[0];
	}	//	function IPMT()

	public static function flattenSingleValue($value = '') 
	{
        while (is_array($value)) {
			$value = array_pop($value);
		}
			
		return $value;
	}
	
	public static function PMT($rate = 0, $nper = 0, $pv = 0, $fv = 0, $type = 0) {
		// Validate parameters
		if ($type != 0 && $type != 1) {
			return '#NUM!';
		}
	
		// Calculate
		if (!is_null($rate) && $rate != 0) {
			return (-$fv - $pv * pow(1 + $rate, $nper)) / (1 + $rate * $type) / ((pow(1 + $rate, $nper) - 1) / $rate);
		} else {
			return (-$pv - $fv) / $nper;
		}
	}	//	function PMT()
	
	
	protected function number($number, $decimal = 0)
	{
		return number_format($number, $decimal, '.', ',');
	}
	
	protected function percentage($number, $decimal = 0)
	{
		return number_format($number, $decimal, '.', ',') . '%';
	}
	
	protected function currency($sales_forecast_lib, $number)
	{
		return $sales_forecast_lib->defaultCurrency . $this->number($number, 2);
	}
	
	public function farraynumber($tarray) {
	
		$currency = $this->currency;
		
	
		foreach($tarray as $key=>$value) {
				
			$value = str_replace(array($currency,','), '', $value);
				
			if (is_numeric($value)) {
				if ($value < 0) {
					$tarray[$key] = "({$currency}" . $this->number($value * -1, 0) . ')';
				}
				else {
					$tarray[$key] = $currency . $this->number($value, 0);
				}
			} else {
				$tarray[$key] = $value;
			}
		}
	
		return $tarray;
	
	}
	
	public function farraypercent($tarray) {
	
		foreach($tarray as $key=>$value) {
			
			$value = str_replace(array(','), '', $value);
			
			if (is_numeric($value)) {
				if ($value < 0) {
					$tarray[$key] = "(" . $this->number(percentage * -1, 0) . ')';
				}
				else {
					$tarray[$key] = $this->percentage($value, 0);
				}
			} else {
				$tarray[$key] = $value;
			}
			
			$tarray[$key] = $this->percentage($value, 0);
		}
	
		return $tarray;
	
	}
}