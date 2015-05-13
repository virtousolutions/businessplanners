<?php
class PlanFinancialStatementsCalculatorService 
extends PlanCalculatorService
{
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
        parent::__construct($plan);

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
            $pre_tax_profit[0] < 0 ? 0 : $pre_tax_profit[0] * ($this->business_plan->bp_income_tax_in_percentage / 100),
            $pre_tax_profit[1] < 0 ? 0 : $pre_tax_profit[1] * ($this->business_plan->bp_income_tax_in_percentage / 100),
            $pre_tax_profit[2] < 0 ? 0 : $pre_tax_profit[2] * ($this->business_plan->bp_income_tax_in_percentage / 100)
        ];
        
        $this->yearly_net_profit = [
            $pre_tax_profit[0] - $this->yearly_income_tax[0], 
            $pre_tax_profit[1] - $this->yearly_income_tax[1], 
            $pre_tax_profit[2] - $this->yearly_income_tax[2], 
        ];

        $yearly_expenses    = $this->budget_calc->getExpensesYearlyTotals();
        $yearly_total_costs = $this->sales_calc->getYearlyTotalDirectCosts();

        $this->yealy_total_expenses = [
            $yearly_total_costs[0] + $yearly_expenses[0] + $this->yearly_total_interests[0] + $this->yearly_depreciation[0] + $this->yearly_income_tax[0],
            $yearly_total_costs[1] + $yearly_expenses[1] + $this->yearly_total_interests[1] + $this->yearly_depreciation[1] + $this->yearly_income_tax[1],
            $yearly_total_costs[2] + $yearly_expenses[2] + $this->yearly_total_interests[2] + $this->yearly_depreciation[2] + $this->yearly_income_tax[2],
        ];
        
        
        $this->calculateAccountsReceivable();
        $this->calculateAccountsPayable();
        $this->calculateBalanceSheet();
        $this->calculateCashFlow();

        $yearly_total_sales = $this->sales_calc->getYearlyTotalSales();

        $net_profit_percent = [
            ($this->yearly_net_profit[0] / $yearly_total_sales[0]) * 100,
            ($this->yearly_net_profit[1] / $yearly_total_sales[1]) * 100,
            ($this->yearly_net_profit[2] / $yearly_total_sales[2]) * 100
        ];

        $this->profit_and_loss_data = [
            'gross_margin' => $this->sales_calc->getYearlyGrossMargin(),
            'operating_expenses' => $this->budget_calc->getExpensesYearlyTotals(),
            'operating_income' => $this->yearly_operating_income,
            'interest_incurred' => $this->yearly_total_interests,
            'depreciation' => $this->yearly_depreciation,
            'income_taxes' => $this->yearly_income_tax,
            'net_profit' => $this->yearly_net_profit,
            'net_profit_percent' => $net_profit_percent,
        ];

        $this->profit_and_loss_labels = [
            'gross_margin' => 'Gross Margin',
            'operating_expenses' => 'Operating Expenses',
            'operating_income' => 'Operating Income',
            'interest_incurred' => 'Interest Incurred',
            'depreciation' => 'Depreciation and Amortization',
            'income_taxes' => 'Income Taxes',
            'net_profit' => 'Net Profit',
            'net_profit_percent' => 'Net Profit / Sales',
        ];

        // monthly data
        $this->monthly_totals = [
            'operating_income' => $this->monthly_operating_income,
            'interest_incurred' => $this->monthly_total_interest,
            'depreciation' => $this->monthly_accumulated_depreciation,
            'income_tax' => $this->monthly_income_tax,
            'net_profit' => $this->monthly_net_profit,
            'net_profit_percent' => $this->monthly_net_profit_percent,
        ];
	}

    protected function calculateOperatingIncome()
    {
        /*** Calculate the operating income **/
        $total_sales = $this->sales_calc->getMonthlyTotalSales();
        $total_costs = $this->sales_calc->getMonthlyTotalCosts();
        $monthly_gross_margin = $this->sales_calc->getMonthlyGrossMargin();
        $monthly_expenses = $this->budget_calc->getExpensesMonthlyTotals();
        $this->monthly_operating_income = [];

        for ($x = 0; $x < 12; $x++) {
            $this->monthly_operating_income[$x] = $monthly_gross_margin[$x] - $monthly_expenses[$x];
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
        $monthly_total_repayments = $monthly_total_balance = $monthly_total_interest = [
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        ];
        
        $loans = $this->loans_calc->getLoans();
        $monthly_total_loans = $this->loans_calc->getLoansMonthlyTotals();

        foreach ($loans as $loan) {
            $interest_rate = $loan->loan_invest_interest_rate / 100;
			$period	= $loan->loan_invest_pays_per_years;
			$terms	= $loan->loan_invest_years_to_pay;
			$pmtperiod = $period * $terms;
            $start_interest = $prev_interest = ($loan->totals[0] * $interest_rate) * ($terms / $period);
            $start_repayment = $prev_repayment = $loan->totals[0] / ($period * 1);
            $start_balance = $prev_balance = 0;
            
			for($i = 0; $i < 36; $i++) {
                $key = "limr_month_" . ((($i + 1) < 10) ? '0' : '') . ($i + 1);
                $val = isset($loan->$key) ? $loan->$key : 0;
            
                if (($prev_balance + $val) > 1) {
                    $repayment = $start_repayment + $start_interest;
                    $interest  = $start_interest;
                }
                else {
                    $repayment = 0;
                    $interest  = 0;
                }

                if (($prev_balance + $val) < 1) {
                    $balance = 0;
                }
                else {
                    $balance = $prev_balance + $val - $start_repayment;
                }

                $prev_balance = $balance;

                $year_index  = intval($i/12);
                $month_index = ($i % 12);

                $monthly_total_repayments[$year_index][$month_index] += $repayment;
                $monthly_total_balance[$year_index][$month_index]    += $balance;
                $monthly_total_interest[$year_index][$month_index]   += $interest;
			}
        }
        
        $yearly_total_loans = $this->loans_calc->getLoansYearlyTotals();
        $this->yearly_total_interests = [
            array_sum($monthly_total_interest[0]), 
            array_sum($monthly_total_interest[1]), 
            array_sum($monthly_total_interest[2])
        ];
        $this->yearly_total_repayments = [
            array_sum($monthly_total_repayments[0]), 
            array_sum($monthly_total_repayments[1]), 
            array_sum($monthly_total_repayments[2])
        ];
        
        /*** End calculating interest rate **/

        $this->monthly_total_interest = $monthly_total_interest[0];
        $this->monthly_total_repayments = $monthly_total_repayments[0];
        $this->monthly_total_balance = $monthly_total_balance[0];
    }

    protected function calculateDepreciation()
    {
        $monthly_total_interest = $this->monthly_total_interest;

        /*** Calculate depreciation **/
        $total_sales = $this->sales_calc->getMonthlyTotalSales();
        $purchases = $this->budget_calc->getPurchases();
        $monthly_depreciation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_accumulated_depreciation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_income_tax = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_net_profit = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_net_profit_percent = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
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
            $pre_tax_profit = $this->monthly_operating_income[$i] - $monthly_total_interest[$i] - $monthly_accumulated_depreciation[$i];
            $monthly_income_tax[$i] = $pre_tax_profit * ($this->business_plan->bp_income_tax_in_percentage / 100);
            $monthly_net_profit[$i] = $pre_tax_profit - $monthly_income_tax[$i];
            $monthly_net_profit_percent[$i] = $total_sales[$i] > 0 ? (($monthly_net_profit[$i] / $total_sales[$i]) * 100) : 0;
        }

        $yearly_purchases = $this->budget_calc->getPurchasesYearlyTotals();
        $monthly_purchases = $this->budget_calc->getPurchasesMonthlyTotals();

        $this->yearly_depreciation = [array_sum($monthly_accumulated_depreciation), 0, 0];
        $this->yearly_depreciation[1] = ($yearly_purchases[0] + $yearly_purchases[1] - $this->yearly_depreciation[0]) * 0.2;
        $this->yearly_depreciation[2] = ($yearly_purchases[0] + $yearly_purchases[1] + $yearly_purchases[2] - $this->yearly_depreciation[0] - $this->yearly_depreciation[1]) * 0.2;
        /*** End calculating depreciation **/

        $this->monthly_accumulated_depreciation = $monthly_accumulated_depreciation;
        $this->monthly_income_tax = $monthly_income_tax;
        $this->monthly_net_profit = $monthly_net_profit;
        $this->monthly_net_profit_percent = $monthly_net_profit_percent;
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
            $other_receivable = $j >= 0 ? $monthly_receivable[$j] : 0;

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
        $monthly_salaries = $this->personnel_calc->getPersonnelsMonthlyTotals();
        $monthly_related_expenses = $this->personnel_calc->getRelatedExpensesMonthlyTotals();

        $percent_on_credit = $cash_flow_data->outgoing_percentage / 100;
		$days_to_pay       = $cash_flow_data->outgoing_collection;
        $index_to_pay      = $days_to_pay / 30;

        $monthly_payable_amount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_cash_paid      = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_payable        = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $total_cash_collected   = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $total_accounts_payable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        for ($i = 0; $i < 12; $i++) {
            $payable = $total_costs[$i] + $monthly_expenses[$i] - $monthly_salaries[$i] - $monthly_related_expenses[$i];
            $credit_amount = $payable * $percent_on_credit;
            $monthly_payable_amount[$i] = $payable;
            $monthly_cash_paid[$i] = $payable - $credit_amount;
            $monthly_payable[$i] = $credit_amount;
            
            $j = $i - $index_to_pay;
            $other_payable = $j >= 0 ? $monthly_payable[$j] : 0;

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
        $monthly_investments = $this->loans_calc->getInvestmentsMonthlyTotals();
        $starting_cash = 0;
        $monthly_cash = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_current_assets = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_long_term_assets =  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_accumulated_depreciation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_long_term_assets = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_assets = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_current_total_liabilities = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_liabilities = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_paid_in_capital = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_retained_earnings = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_total_owner_equity = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i < 12; $i++) {
            $monthly_cash[$i] = ($i == 0 ? $starting_cash : $monthly_cash[$i - 1]) 
                + $monthly_total_loans[$i] 
                - $this->monthly_total_repayments[$i] 
                + $monthly_investments[$i]
                + $this->monthly_cash_collected[$i] 
                - $this->monthly_cash_paid[$i]
                - $monthly_salaries[$i] 
                - $monthly_related_expenses[$i]
                - $this->monthly_income_tax[$i] 
                + ($monthly_purchases[$i] * -1);

            $monthly_total_current_assets[$i] = $monthly_cash[$i] + $this->monthly_accounts_receivable[$i];
            $monthly_long_term_assets[$i] = ($i == 0 ? 0 : $monthly_long_term_assets[$i - 1]) + $monthly_purchases[$i];
            $monthly_accumulated_depreciation[$i] = ($i == 0 ? 0 : $monthly_accumulated_depreciation[$i - 1]) - $this->monthly_accumulated_depreciation[$i];
            $monthly_total_long_term_assets[$i] = $monthly_long_term_assets[$i] + $monthly_accumulated_depreciation[$i];
            $monthly_total_assets[$i] = $monthly_total_current_assets[$i] + $monthly_total_long_term_assets[$i];
            $monthly_current_total_liabilities[$i] = $this->monthly_accounts_payable[$i];
            $monthly_total_liabilities[$i] = $monthly_current_total_liabilities[$i] + $this->monthly_total_balance[$i];
            $monthly_paid_in_capital[$i] = ($i == 0 ? 0 : $monthly_paid_in_capital[$i - 1]) + ($monthly_investments[$i]);
            $monthly_retained_earnings[$i] = $i == 0 ? 0 : ($monthly_retained_earnings[$i - 1] + $this->monthly_net_profit[$i - 1]);
            $monthly_total_owner_equity[$i] = $monthly_paid_in_capital[$i] + $monthly_retained_earnings[$i] + $this->monthly_net_profit[$i];
            $monthly_total_liabilities_equity[$i] = $monthly_total_liabilities[$i] + $monthly_total_owner_equity[$i];
        }
        
        $yearly_total_sales     = $this->sales_calc->getYearlyTotalSales();
        $yearly_total_costs     = $this->sales_calc->getYearlyTotalDirectCosts();
        $yearly_total_loans     = $this->loans_calc->getLoansYearlyTotals();
        $yearly_total_purchases = $this->budget_calc->getPurchasesYearlyTotals();

        $this->yearly_accounts_receivable[0] = $this->monthly_accounts_receivable[11];
        $this->yearly_accounts_receivable[1] = $this->yearly_accounts_receivable[0] / $yearly_total_sales[0] * $yearly_total_sales[1];
        $this->yearly_accounts_receivable[2] = $this->yearly_accounts_receivable[0] / $yearly_total_sales[0] * $yearly_total_sales[2];

        $this->yearly_accounts_payable[0] = $this->monthly_accounts_payable[11];
        $this->yearly_accounts_payable[1] = $this->yearly_accounts_payable[0] / $yearly_total_costs[0] * $yearly_total_costs[1];
        $this->yearly_accounts_payable[2] = $this->yearly_accounts_payable[0] / $yearly_total_costs[0] * $yearly_total_costs[2];
        
        $this->yearly_cash[0] = $monthly_cash[11];

        $this->yearly_cash[1] = $this->yearly_cash[0] 
            + $this->yearly_accounts_receivable[0] 
            + $yearly_total_sales[1] 
            - $this->yearly_accounts_receivable[1] 
            + $yearly_total_loans[1] 
            - $this->yearly_total_repayments[1] 
            - $yearly_total_purchases[1] 
            - $this->yearly_accounts_payable[0] 
            - $this->yealy_total_expenses[1] 
            + $this->yearly_accounts_payable[1] 
            + $this->yearly_depreciation[1];
        
        $this->yearly_cash[2] = $this->yearly_cash[1] + $this->yearly_accounts_receivable[1] + $yearly_total_sales[2] - $this->yearly_accounts_receivable[2] + $yearly_total_loans[2] - $this->yearly_total_repayments[2] - $yearly_total_purchases[2] - $this->yearly_accounts_payable[1] - $this->yealy_total_expenses[2] + $this->yearly_accounts_payable[2] + $this->yearly_depreciation[2];

        $this->yearly_total_current_assets = [
            $this->yearly_cash[0] + $this->yearly_accounts_receivable[0],
            $this->yearly_cash[1] + $this->yearly_accounts_receivable[1],
            $this->yearly_cash[2] + $this->yearly_accounts_receivable[2]
        ];

        // calculate long term assets
        $this->yearly_long_term_assets[0] = $yearly_total_purchases[0];
        $this->yearly_long_term_assets[1] = $this->yearly_long_term_assets[0] + $yearly_total_purchases[1];
        $this->yearly_long_term_assets[2] = $this->yearly_long_term_assets[1] + $yearly_total_purchases[2];

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

        $investments_totals = $this->loans_calc->getInvestmentsYearlyTotals();
        
        $this->yearly_paid_in_capital[0] = $investments_totals[0];
        $this->yearly_paid_in_capital[1] = $this->yearly_paid_in_capital[0] + $investments_totals[1];
        $this->yearly_paid_in_capital[2] = $this->yearly_paid_in_capital[1] + $investments_totals[2];
        
        $this->yearly_earnings = $this->yearly_net_profit;
        $this->yearly_retained_earnings[0] = 0;
        $this->yearly_retained_earnings[1] = $this->yearly_retained_earnings[0] + $this->yearly_earnings[0];
        $this->yearly_retained_earnings[2] = $this->yearly_retained_earnings[1] + $this->yearly_earnings[1];
        
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
        
        $this->balance_sheet_monthly_data = [
            'cash' => $monthly_cash,
            'accounts_receivable' => $this->monthly_accounts_receivable,
            'total_current_assets' => $monthly_total_current_assets,
            'long_term_assets' => $monthly_long_term_assets,
            'accumulated_depreciation' => $monthly_accumulated_depreciation,
            'total_long_term_assets' => $monthly_total_long_term_assets,
            'total_assets' => $monthly_total_assets,
            'accounts_payable' => $this->monthly_accounts_payable,
            'current_liabilities' => $monthly_current_total_liabilities,
            'long_term_debt' => $this->monthly_total_balance,
            'total_liabilities' => $monthly_total_liabilities,
            'paid_in_capital' => $monthly_paid_in_capital,
            'retained_earnings' => $monthly_retained_earnings,
            'earnings' => $this->monthly_net_profit,
            'total_owner_equity' => $monthly_total_owner_equity,
            'total_liabilities_equity' => $monthly_total_liabilities_equity
        ];
    }

    public function calculateCashFlow()
    {
        $monthly_change_in_accounts_recievable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_change_in_accounts_payable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_net_cash_flow_from_operations = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_purchases = $this->budget_calc->getPurchasesMonthlyTotals();
        $monthly_change_in_long_term_debt = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_net_cash_flow_from_investing_financing = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_cash_at_beginning = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_net_change_in_cash = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_cash_at_end = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $monthly_investments = $this->loans_calc->getInvestmentsMonthlyTotals();
        
        for ($x = 0; $x < 12; $x++) {
            $monthly_change_in_accounts_recievable[$x] = ($x == 0 ? 0 : $this->monthly_accounts_receivable[$x - 1]) - $this->monthly_accounts_receivable[$x];
            $monthly_change_in_accounts_payable[$x] = $this->monthly_accounts_payable[$x] - ($x == 0 ? 0 : $this->monthly_accounts_payable[$x - 1]);
            $monthly_net_cash_flow_from_operations[$x] = $this->monthly_net_profit[$x] + $this->monthly_accumulated_depreciation[$x] + $monthly_change_in_accounts_recievable[$x] + $monthly_change_in_accounts_payable[$x];
            $monthly_change_in_long_term_debt[$x] = $x == 0 ? $this->monthly_total_balance[$x] : ($this->monthly_total_balance[$x] - $this->monthly_total_balance[$x - 1]);
            $monthly_net_cash_flow_from_investing_financing[$x] = ($monthly_purchases[$x] * -1) + $monthly_investments[$x] + $monthly_change_in_long_term_debt[$x];
            $monthly_cash_at_beginning[$x] = $x == 0 ? 0 : ($monthly_cash_at_end[$x - 1]);
            $monthly_net_change_in_cash[$x] = $monthly_net_cash_flow_from_operations[$x] + $monthly_net_cash_flow_from_investing_financing[$x];
            $monthly_cash_at_end[$x] = $monthly_cash_at_beginning[$x] + $monthly_net_change_in_cash[$x];
        }

        $change_in_accounts_recievable[0] = 0 - $this->yearly_accounts_receivable[0];
        $change_in_accounts_recievable[1] = $this->yearly_accounts_receivable[0] - $this->yearly_accounts_receivable[1];
        $change_in_accounts_recievable[2] = $this->yearly_accounts_receivable[1] - $this->yearly_accounts_receivable[2];

        $change_in_accounts_payable[0] = 0 + $this->yearly_accounts_payable[0];
        $change_in_accounts_payable[1] = $this->yearly_accounts_payable[1] - $this->yearly_accounts_payable[0];
        $change_in_accounts_payable[2] = $this->yearly_accounts_payable[2] - $this->yearly_accounts_payable[1];

        $net_cash_flow_from_operations = [
            $this->yearly_net_profit[0] + $this->yearly_depreciation[0] + $change_in_accounts_recievable[0] + $change_in_accounts_payable[0],
            $this->yearly_net_profit[1] + $this->yearly_depreciation[1] + $change_in_accounts_recievable[1] + $change_in_accounts_payable[1],
            $this->yearly_net_profit[2] + $this->yearly_depreciation[2] + $change_in_accounts_recievable[2] + $change_in_accounts_payable[2],
        ];

        $purchases = $this->budget_calc->getPurchasesYearlyTotals();

        $change_in_long_term_debt[0] = $this->yearly_long_term_debt[0];
        $change_in_long_term_debt[1] = $this->yearly_long_term_debt[1] - $this->yearly_long_term_debt[0];
        $change_in_long_term_debt[2] = $this->yearly_long_term_debt[2] - $this->yearly_long_term_debt[1];

        $net_cash_flow_from_investing_financing = [
            $this->yearly_paid_in_capital[0] + ($purchases[0] * -1) + $change_in_long_term_debt[0],
            ($purchases[1] * -1) + $change_in_long_term_debt[1],
            ($purchases[2] * -1) + $change_in_long_term_debt[2],
        ];

        $net_change_in_cash = [
            $net_cash_flow_from_operations[0] + $net_cash_flow_from_investing_financing[0],
            $net_cash_flow_from_operations[1] + $net_cash_flow_from_investing_financing[1],
            $net_cash_flow_from_operations[2] + $net_cash_flow_from_investing_financing[2],
        ];

        $cash_at_beginning[0] = 0;
        $cash_at_end[0] = $cash_at_beginning[0] + $net_change_in_cash[0];

        $cash_at_beginning[1] = $cash_at_end[0];
        $cash_at_end[1] = $cash_at_beginning[1] + $net_change_in_cash[1];

        $cash_at_beginning[2] = $cash_at_end[1];
        $cash_at_end[2] = $cash_at_beginning[2] + $net_change_in_cash[2];

        $this->cash_flow_data = [
            'net_profit' => $this->yearly_net_profit,
            'depreciation' => $this->yearly_depreciation,
            'change_in_accounts_recievable' => $change_in_accounts_recievable,
            'change_in_accounts_payable' => $change_in_accounts_payable,
            'net_cash_flow_from_operations' => $net_cash_flow_from_operations,
            'assets_purchased_or_sold' => $purchases,
            'investments_received' => $this->loans_calc->getInvestmentsYearlyTotals(),
            'change_in_long_term_debt' => $change_in_long_term_debt,
            'net_cash_flow_from_investing_financing' => $net_cash_flow_from_investing_financing,
            'cash_at_beginning' => $cash_at_beginning,
            'net_change_in_cash' => $net_change_in_cash,
            'cash_at_end' => $cash_at_end
        ];

        $this->cash_flow_monthly_data = [
            'net_profit' => $this->monthly_net_profit,
            'depreciation' => $this->monthly_accumulated_depreciation,
            'change_in_accounts_recievable' => $monthly_change_in_accounts_recievable,
            'change_in_accounts_payable' => $monthly_change_in_accounts_payable,
            'net_cash_flow_from_operations' => $monthly_net_cash_flow_from_operations,
            'assets_purchased_or_sold' => $monthly_purchases,
            'investments_received' => $monthly_investments,
            'change_in_long_term_debt' => $monthly_change_in_long_term_debt,
            'net_cash_flow_from_investing_financing' => $monthly_net_cash_flow_from_investing_financing,
            'cash_at_beginning' => $monthly_cash_at_beginning,
            'net_change_in_cash' => $monthly_net_change_in_cash,
            'cash_at_end' => $monthly_cash_at_end
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

    public function getProfitAndLossData()
    {
        return $this->profit_and_loss_data;
    }

    public function getProfitAndLossLabels()
    {
        return $this->profit_and_loss_labels;
    }

    public function getBalanceSheetData()
    {
        return $this->balance_sheet_data ;
    }

    public function getBalanceSheetMonthlyData()
    {
        return $this->balance_sheet_monthly_data ;
    }
    
    public function getCashFlowData()
    {
        return $this->cash_flow_data;
    }

    public function getCashFlowMonthlyData()
    {
        return $this->cash_flow_monthly_data;
    }

    public function getMonthlyTotals()
    {
        return $this->monthly_totals;
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
}