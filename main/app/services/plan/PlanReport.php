<?php

class PlanReport extends TCPDF {

    protected $business_plan;
    protected $user;
    protected $contents;
    protected $add_financial_statements;
    protected $graphs = [];
    protected $img_path = 'img/pdf';

    public function __construct(BusinessPlan $business_plan, User $user, $contents, $add_financial_statements)
    {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215.9,279.4), true, 'UTF-8', false);

        // set document information
        $this->SetCreator('');
        $this->SetAuthor('Pro Media Consultants');
        $this->SetTitle('Business Planner Report');
        $this->SetSubject('PDF Export');

        // set default header data
        //$this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

        // set header and footer fonts
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(8);
        $this->SetFooterMargin(1);        
        //$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$this->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$this->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $this->setLanguageArray($l);
        }

        // set font
        $this->setTextColor(0, 0, 0);
        //    $this->SetFont('dejavusans', '', 10);
        $this->business_plan = $business_plan;
        $this->user = $user;
        $this->contents = $contents;
        $this->add_financial_statements = $add_financial_statements;
    }

    public function Header() {
        if ($this->getNumPages() == 1) {
            return;                    
        } 

        $pagetext = intval($this->getAliasNumPage());
    
        if ($this->tocpage) {
            // *** replace the following parent::Header() with your code for TOC page
            $pagetext = $this->getRoman($this->getNumPages()- $this->numnormalpages);

        } else {
            // *** replace the following parent::Header() with your code for normal pages
            //parent::Header();
            
            $t = intval($this->getAliasNbPages());
            $p = intval($this->getAliasNumPage());
            
            $pagetext = $this->getNumPages() - 1;
        }
        
        $img = ($this->CurOrientation == 'P' ? 'head-bg-smaller.jpg' : 'head-bg-wider.jpg');
        $width = ($this->CurOrientation=='P'?215.9:279.4);
    
        $this->Image('assets/img/pdf/' . $img, 0, 0, $width, 25.4, 'JPEG',null ,null ,2);
        
        $this->setTextColor(255, 204, 51);            
        $this->SetFont('rockb', '', 12, '', true);
        $this->MultiCell(0, 5, $this->business_plan->bp_name, 0, 'L', 0, 0, '', 15, true);
        $this->SetFont('rockb', '', 9, '', true);
        $this->MultiCell(0, 5, $pagetext, 0, 'R', 0, 0, '', 15, true);
        
    }

    /**
      * Overwrite Footer() method.
     * @public
     */
    public function Footer() {
        if ($this->getNumPages() == 1) {
            return;                    
        } 
        
        // *** replace the following parent::Footer() with your code for TOC page
        $this->SetY(-13);                                        
        $this->SetTextColorArray(array(0,0,0));
        //set style for cell border
        
        //$this->SetY(-20);
        $this->SetFont('FRABK', '', 7.5, '', true);
        
        $html = '<div style="padding-top: 10px; border-top: 1px solid #000"><br><span style="font-family: helvetica; font-weight: bold">CONFIDENTIAL - DO NOT DISSEMINATE.</span> This business plan contains confidential, trade-secret information and is shared only with the
understanding that you will not share its contents or ideas with third parties without the express written consent of the plan author.</div>';
        
        
        //$this->Cell(0, 25, $html, 0, 1, 'L');
        $this->writeHTMLCell(0, 20, '', '',$html, 0, 0, 0, true ,'L' );
    }

    public function getRoman($num) {
        $n = intval($num);
        $res = '';

        /*** roman_numerals array  ***/
        $roman_numerals = array(
            'm'  => 1000,
            'cm' => 900,
            'd'  => 500,
            'cd' => 400,
            'c'  => 100,
            'xc' => 90,
            'l'  => 50,
            'xl' => 40,
            'x'  => 10,
            'ix' => 9,
            'v'  => 5,
            'iv' => 4,
            'i'  => 1);

        foreach ($roman_numerals as $roman => $number){
            /*** divide to get  matches ***/
            $matches = intval($n / $number);

            /*** assign the roman char * $matches ***/
            $res .= str_repeat($roman, $matches);

            /*** substract from the number ***/
            $n = $n % $number;
        }

        /*** return the res ***/
        return $res; 
    }

    public function toPdf($output)
    {
        $this->buildCoverPage();
        $this->buildPages();
        $this->buildAppendix();
        $this->buildTOC();
        
        $this->Output($this->business_plan->bp_name . " Business Plan.pdf", $output);
    }

    public function buildCoverPage()
    {
        $prepared = date('F Y');
    
        //do not print header and footer in cover page
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        
        $this->AddPage();
        
        //pagebreak off to expand images
        $this->SetAutoPageBreak(false,0);
        
        $this->Image('assets/img/pdf/cover-bg.jpg', 0, 0, 215.9,279.4, 'JPEG',null ,null ,2);
    
        // Set some content to print
        $html = 'CONFIDENTIAL MESSAGE';

        $this->setTextColor(255, 204, 51);
        $this->MultiCell(155, 5, $html, 0, 'L', 0, 0, '', 96.2, true);

        $this->SetFont('rockb', '', 50, '', true);
        $this->MultiCell(155, 20, strtoupper($this->business_plan->bp_name), 0, 'L', 0, 0, '', 102.2, true);
        //$this->MultiCell(155, 20, 'COMPANY', 0, 'L', 0, 0, '', 122, true);

        //$this->SetFont('fradmcn', '', 12, '', true);
        //$this->MultiCell(155, 5, 'THE NEW FORCE IN ACCOUNTANCY PRACTICE', 0, 'L', 0, 0, '', 145, true);

        $this->SetFont('fradmcn', '', 20, '', true);
        $this->setTextColor(0, 0, 0);
        $this->MultiCell(155, 5, 'BUSINESS PLAN', 0, 'L', 0, 0, '', 160, true);

        $this->SetFont('rock', '', 10, '', true);
        $this->MultiCell(155, 5, "Prepared {$prepared}", 0, 'L', 0, 0, '', 168, true);

        $this->SetFont('fradmcn', '', 15, '', true);
        $this->setTextColor(204, 0, 0);

        $this->MultiCell(155, 5, 'CONTACT INFORMATION', 0, 'L', 0, 0, '', 245, true);

        $this->SetFont('fradmcn', '', 11.5, '', true);
        $this->setTextColor(255, 204, 51);
        $this->MultiCell(0, 5, $this->business_plan->contact_name, 0, 'L', 0, 0, '', 253, true);
        
        $this->MultiCell(0, 5, $this->business_plan->email, 0, 'L', 0, 0, '', 258, true);

        if (!empty($this->business_plan->telephone)) {
            $this->MultiCell(0, 5, $this->business_plan->telephone, 0, 'L', 0, 0, '', 263, true);
        }

        $y_pos = 253;

        $this->MultiCell(0, 5, $this->business_plan->address_1, 0, 'R', 0, 0, '', $y_pos, true);
        $y_pos += 5;
        
        if (!empty($this->business_plan->address_2)) {
            $this->MultiCell(0, 5, $this->business_plan->address_2, 0, 'R', 0, 0, '', $y_pos, true);
            $y_pos += 5;
        }

        $this->MultiCell(0, 5, ($this->business_plan->city . ', ' . $this->business_plan->post_code), 0, 'R', 0, 0, '', $y_pos, true);
        $y_pos += 5;

        $this->MultiCell(0, 5, $this->business_plan->getCountryName(), 0, 'R', 0, 0, '', $y_pos, true);
        
        //reset true to include header and footer for succeeding pages
        $this->setPrintHeader(true);
        $this->setPrintFooter(true);
        
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    }

    public function buildTOC() { //must be called after all pages were created
        //mark number of normal pages
        $this->numnormalpages = $this->getNumPages();

        // add a new page for TOC
        $this->addTOCPage('P');

        // write the TOC title and/or other elements on the TOC page
        $this->SetFont('rock', 'b', 20);
        $this->setTextColor(0, 0, 0);
        $this->Ln();
        $this->MultiCell(0, 0, 'Table Of Contents', 0, 'L', 0, 1, '', '', true, 0);
        $this->SetFont('rock', '', 15);	
        $this->addTOC(2, 'rock', '.','Table of Contents', '', array(128,0,0));
        // end of TOC page
        $this->endTOCPage();

    }

    public function buildPages()
    {
        $this->SetMargins(14, PDF_MARGIN_TOP, 15);

        foreach ($this->contents as $content) {
            $this->writeHeader($content['title'], 'P');
            
            foreach ($content['sub_pages']as $sub_page) {
                $this->Ln(3);
                $this->renderPageTitle($sub_page['title']);
                $this->renderPageContent($sub_page['content']);
            }
        }
    }

    public function buildAppendix()
    {
        $this->SetMargins(14, PDF_MARGIN_TOP, 15);
        $this->writeHeader('Appendix', 'L');

        $sales_calculator = new PlanSalesCalculatorService($this->business_plan);
        $personnel_calculator = new PlanPersonnelCalculatorService($this->business_plan);
        $budget_calculator = new PlanBudgetCalculatorService($this->business_plan, $personnel_calculator);
        $fund_calculator = new PlanLoansCalculatorService($this->business_plan);
        $fs_calculator = new PlanFinancialStatementsCalculatorService($this->business_plan, $sales_calculator, $personnel_calculator, $budget_calculator, $fund_calculator);
        
        $this->renderSalesForecast($sales_calculator);
        $this->addPage('L');
        $this->renderPersonnelPlan($personnel_calculator);
        $this->addPage('L');
        $this->renderBudget($budget_calculator, $personnel_calculator);
        $this->addPage('L');
        $this->renderFundings($fund_calculator);

        if ($this->add_financial_statements === true) {
            $this->addPage('L');
            $this->renderProfitAndLoss($fs_calculator, $sales_calculator, $budget_calculator);
            $this->addPage('L');
            $this->renderBalanceSheet($fs_calculator);
            $this->addPage('L');
            $this->renderCashFlow($fs_calculator);
        }
    }

    protected function renderSalesForecast($sales_calculator)
    {
        $sales = $sales_calculator->getSales();
        $monthly_sales = $sales_calculator->getMonthlyTotalSales();
        $monthly_costs = $sales_calculator->getMonthlyTotalCosts();
        
        $html_unit_sales = "<table>";
        $html_price = "<table>";
        $html_sales = "<table>";
        $html_unit_cost = "<table>";
        $html_cost = "<table>";
        $html_y_unit_sales = "<table>";
        $html_y_price = "<table>";
        $html_y_sales = "<table>";
        $html_y_unit_cost = "<table>";
        $html_y_cost = "<table>";

        foreach ($sales as $sale) {
            $a_unit_sale = $a_price = $a_sale = $a_unit_cost = $a_cost = '<tr style="font-size: 12px; color: #000000;"><td>' . $sale->sales_forecast_name . '</td>';
            $y_unit_sale = $y_price = $y_sale = $y_unit_cost = $y_cost = '<tr style="font-size: 12px; color: #000000;"><td colspan="2">' . $sale->sales_forecast_name . '</td>';

            for ($index = 0; $index < 12; $index++) {
                $key = "month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                $value = $sale->$key;

                $a_unit_sale .= '<td style="text-align: right;">' . $value . '</td>';
                $a_price .= '<td style="text-align: right;">' . $sales_calculator->formatNumberDisplay($sale->price, 0) . '</td>';
                $a_sale .= '<td style="text-align: right;">' . $sales_calculator->formatNumberDisplay($sale->price * $value, 0) . '</td>';
                $a_unit_cost .= '<td style="text-align: right;">' . $sales_calculator->formatNumberDisplay($sale->cost, 0) . '</td>';
                $a_cost .= '<td style="text-align: right;">' . $sales_calculator->formatNumberDisplay($sale->cost * $value, 0) . '</td>';
            }
            
            for ($x = 0; $x < 3; $x++) {
                $y_unit_sale .= '<td style="text-align: right;" colspan="2">' . $sale->totals[$x] . '</td>';
                $y_price .= '<td style="text-align: right;" colspan="2">' . $sales_calculator->formatNumberDisplay($sale->price, 0) . '</td>';
                $y_sale .= '<td style="text-align: right;" colspan="2">' . $sales_calculator->formatNumberDisplay($sale->total_sales[$x], 0) . '</td>';
                $y_unit_cost .= '<td style="text-align: right;" colspan="2">' . $sales_calculator->formatNumberDisplay($sale->cost, 0) . '</td>';
                $y_cost .= '<td style="text-align: right;" colspan="2">' . $sales_calculator->formatNumberDisplay($sale->total_costs[$x], 0) . '</td>';
            }
            
            $a_unit_sale .= '</tr>';
            $a_price .= '</tr>';
            $a_sale .= '</tr>';
            $a_unit_cost .= '</tr>';
            $a_cost .= '</tr>';

            $y_unit_sale .= '<td colspan="5"></td></tr>';
            $y_price .= '<td colspan="5"></td></tr>';
            $y_sale .= '<td colspan="5"></td></tr>';
            $y_unit_cost .= '<td colspan="5"></td></tr>';
            $y_cost .= '<td colspan="5"></td></tr>';

            $html_unit_sales .= $a_unit_sale;
            $html_price .= $a_price;
            $html_sales .= $a_sale;
            $html_unit_cost .= $a_unit_cost;
            $html_cost .= $a_cost;

            $html_y_unit_sales .= $y_unit_sale;
            $html_y_price .= $y_price;
            $html_y_sales .= $y_sale;
            $html_y_unit_cost .= $y_unit_cost;
            $html_y_cost .= $y_cost;
        }

        $html_unit_sales .= "</table>";
        $html_price .= "</table>";
        $html_sales .= "</table>";
        $html_unit_cost .= "</table>";
        $html_cost .= "</table>";

        $html_y_unit_sales .= "</table>";
        $html_y_price .= "</table>";
        $html_y_sales .= "</table>";
        $html_y_unit_cost .= "</table>";
        $html_y_cost .= "</table>";

        $this->renderPageTitle('Sales Forecast');
        $this->Ln(1);
		//data is calculated in renderSalesForecast function call          
		$this->writeH3('Sales Forecast Table (With Monthly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateMonths(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Unit Sales');
		$this->Ln(1);
        $this->writeHTML($html_unit_sales, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Price Per Unit');
		$this->Ln(1);
        $this->writeHTML($html_price, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Sales');
		$this->Ln(1);
        $this->writeHTML($html_sales, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Direct Cost Per Unit');
		$this->Ln(1);
        $this->writeHTML($html_unit_cost, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Direct Cost');
		$this->Ln(1);
        $this->writeHTML($html_cost, false, false, false, false, 'L');
        $this->Ln(1);
        
        $this->Ln(4);
		$this->writeH3('Sales Forecast Table (With Yearly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateYears(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Unit Sales');
		$this->Ln(1);
        $this->writeHTML($html_y_unit_sales, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Price Per Unit');
		$this->Ln(1);
        $this->writeHTML($html_y_price, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Sales');
		$this->Ln(1);
        $this->writeHTML($html_y_sales, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Direct Cost Per Unit');
		$this->Ln(1);
        $this->writeHTML($html_y_unit_cost, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Direct Cost');
		$this->Ln(1);
        $this->writeHTML($html_y_cost, false, false, false, false, 'L');
        $this->Ln(1);
        
        $sales_graph = new SalesGraphService($this->business_plan, $sales_calculator);
        $graphs = $sales_graph->getGraphs();
        
        $this->renderGraphs([
            $graphs['monthly_sales'], 
            $graphs['monthly_gross_margin'], 
            $graphs['yearly_sales'], 
            $graphs['yearly_gross_margin']
        ]);

        $this->graphs += $graphs;
    }

    protected function renderPersonnelPlan($personnel_calculator)
    {
        $personnels = $personnel_calculator->getPersonnels();
        $monthly_totals = $personnel_calculator->getPersonnelsMonthlyTotals();
        $yearly_totals = $personnel_calculator->getPersonnelsYearlyTotals();
        $html_personnels = "<table>";
        $html_y_personnels = "<table>";
        
        foreach ($personnels as $row) {
            $a_personnel = '<tr style="font-size: 12px; color: #000000;"><td>' . $row->employee_name . '</td>';
            $y_personnel = '<tr style="font-size: 12px; color: #000000;"><td colspan="2">' . $row->employee_name . '</td>';

            for ($index = 0; $index < 12; $index++) {
                $key = "month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                $value = $row->$key;

                $a_personnel .= '<td style="text-align: right;">' . $personnel_calculator->formatNumberDisplay($value, 0) . '</td>';
            }

            for ($index = 0; $index < 3; $index++) {
                $y_personnel .= '<td style="text-align: right;" colspan="2">' . $personnel_calculator->formatNumberDisplay($row->totals[$index], 0) . '</td>';
            }
            
            $a_personnel .= '</tr>';
            $y_personnel .= '<td colspan="5"></td></tr>';
            $html_personnels .= $a_personnel;
            $html_y_personnels .= $y_personnel;
        }

        $html_personnels .= '<tr style="font-size: 12px; color: #000000;"><td>Total</td>';

        for ($index = 0; $index < 12; $index++) {
            $html_personnels .= '<td style="text-align: right;">' . $personnel_calculator->formatNumberDisplay($monthly_totals[$index], 0) . '</td>';
        }

        $html_personnels .= "</tr></table>";

        $html_y_personnels .= '<tr style="font-size: 12px; color: #000000;"><td colspan="2">Total</td>';

        for ($index = 0; $index < 3; $index++) {
            $html_y_personnels .= '<td style="text-align: right;" colspan="2">' . $personnel_calculator->formatNumberDisplay($yearly_totals[$index], 0) . '</td>';
        }

        $html_y_personnels .= '<td colspan="5"></td></tr></table>';
        
        $this->renderPageTitle('Personnel Plan');
        $this->Ln(1);
		$this->writeH3('Personnel Plan Table (With Monthly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateMonths(), false, false, false, false, 'L');
        $this->Ln(2);
        $this->writeHTML($html_personnels, false, false, false, false, 'L');
        $this->Ln(1);

        $this->Ln(4);
		$this->writeH3('Personnel Plan Table (With Yearly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateYears(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeHTML($html_y_personnels, false, false, false, false, 'L');
    }

    protected function renderBudget($budget_calculator, $personnel_calculator)
    {
        $months = $this->business_plan->getStartMonths();
        $monthly_salaries = $personnel_calculator->getPersonnelsMonthlyTotals();
        $monthly_related_expenses = $personnel_calculator->getRelatedExpensesMonthlyTotals();
        $yearly_salaries = $personnel_calculator->getPersonnelsYearlyTotals();
        $yearly_related_expenses = $personnel_calculator->getRelatedExpensesYearlyTotals();
        $expenses = $budget_calculator->getExpenses();
        $purchases = $budget_calculator->getPurchases();
        $monthly_total_expenses = $budget_calculator->getExpensesMonthlyTotals();
        $monthly_total_purchases = $budget_calculator->getPurchasesMonthlyTotals();
        $yearly_total_expenses = $budget_calculator->getExpensesYearlyTotals();
        $yearly_total_purchases = $budget_calculator->getPurchasesYearlyTotals();
        
        $html_expenses = "<table>";
        $html_purchases = "<table>";
        $html_y_expenses = "<table>";
        $html_y_purchases = "<table>";
        
        $a_salaries = '<tr><td>Salaries</td>';
        $a_related_expenses = '<tr><td>Employee Related Expenses</td>';

        for ($x = 0; $x < 12; $x++) {
            $a_salaries .= '<td style="text-align: right;">' . $budget_calculator->formatNumberDisplay($monthly_salaries[$x], 0) . '</td>';
            $a_related_expenses .= '<td style="text-align: right;">' . $budget_calculator->formatNumberDisplay($monthly_related_expenses[$x], 0) . '</td>';
        }

        $a_salaries .= '</tr>';
        $a_related_expenses .= '</tr>';

        $html_expenses .= $a_salaries;
        $html_expenses .= $a_related_expenses;

        $y_salaries = '<tr><td colspan="2">Salaries</td>';
        $y_related_expenses = '<tr><td colspan="2">Employee Related Expenses</td>';

        for ($x = 0; $x < 3; $x++) {
            $y_salaries .= '<td style="text-align: right;" colspan="2">' . $budget_calculator->formatNumberDisplay($yearly_salaries[$x], 0) . '</td>';
            $y_related_expenses .= '<td style="text-align: right;" colspan="2">' . $budget_calculator->formatNumberDisplay($yearly_related_expenses[$x], 0) . '</td>';
        }

        $y_salaries .= '<td colspan="5"></td></tr>';
        $y_related_expenses .= '<td colspan="5"></td></tr>';

        $html_y_expenses .= $y_salaries;
        $html_y_expenses .= $y_related_expenses;

        foreach ($expenses as $row) {
            $html_expenses .= '<tr style="font-size: 12px; color: #000000;"><td>' . $row->expenditure_name . '</td>';
            $html_y_expenses .= '<tr style="font-size: 12px; color: #000000;"><td colspan="2">' . $row->expenditure_name . '</td>';

            for ($index = 0; $index < 12; $index++) {
                $key = "month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                $value = $row->$key;

                $html_expenses .= '<td style="text-align: right;">' . $budget_calculator->formatNumberDisplay($value, 0) . '</td>';
            }

            for ($index = 0; $index < 3; $index++) {
                $html_y_expenses .= '<td style="text-align: right;" colspan="2">' . $budget_calculator->formatNumberDisplay($row->totals[$index], 0) . '</td>';
            }
            
            $html_expenses .= '</tr>';
            $html_y_expenses .= '<td colspan="5"></td></tr>';
        }

        $html_expenses .= '<tr><td>Total</td>';

        for ($x = 0; $x < 12; $x++) {
            $html_expenses .= '<td style="text-align: right;">' . $budget_calculator->formatNumberDisplay($monthly_total_expenses[$x], 0) . '</td>';
        }

        $html_expenses .= '</tr>';

        $html_y_expenses .= '<tr><td colspan="2">Total</td>';

        for ($x = 0; $x < 3; $x++) {
            $html_y_expenses .= '<td style="text-align: right;" colspan="2">' . $budget_calculator->formatNumberDisplay($yearly_total_expenses[$x], 0) . '</td>';
        }

        $html_y_expenses .= '<td colspan="5"></td></tr>';

        foreach ($purchases as $row) {
            $html_purchases .= '<tr style="font-size: 12px; color: #000000;"><td>' . $row->mp_name . '</td>';
            $add_value = false;

            foreach ($months as $month) {
                $value = $month == $row->mp_date ? $row->mp_price : 0;
                $html_purchases .= '<td style="text-align: right;">' . $budget_calculator->formatNumberDisplay($value, 0) . '</td>';
            }

            $html_y_purchases .= '<tr style="font-size: 12px; color: #000000;"><td colspan="2">' . $row->mp_name . '</td>';

            for ($index = 0; $index < 3; $index++) {
                $html_y_purchases .= '<td style="text-align: right;" colspan="2">' . $budget_calculator->formatNumberDisplay($row->totals[$index], 0) . '</td>';
            }
            
            $html_purchases .= '</tr>';
            $html_y_purchases .= '<td colspan="5"></td></tr>';
        }

        $html_purchases .= '<tr><td>Total</td>';

        for ($x = 0; $x < 12; $x++) {
            $html_purchases .= '<td style="text-align: right;">' . $budget_calculator->formatNumberDisplay($monthly_total_purchases[$x], 0) . '</td>';
        }

        $html_purchases .= '</tr>';

        $html_y_purchases .= '<tr><td colspan="2">Total</td>';

        for ($x = 0; $x < 3; $x++) {
            $html_y_purchases .= '<td style="text-align: right;" colspan="2">' . $budget_calculator->formatNumberDisplay($yearly_total_purchases[$x], 0) . '</td>';
        }

        $html_y_purchases .= '<td colspan="5"></td></tr>';

        $html_expenses .= "</table>";
        $html_purchases .= "</table>";
        $html_y_expenses .= "</table>";
        $html_y_purchases .= "</table>";
        
        $this->renderPageTitle('Budget');
        $this->Ln(1);
		$this->writeH3('Budget Table (With Monthly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateMonths(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Expenses');
		$this->Ln(1);
        $this->writeHTML($html_expenses, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Major Purchases');
		$this->Ln(1);
        $this->writeHTML($html_purchases, false, false, false, false, 'L');
        $this->Ln(1);

        $this->Ln(4);
		$this->writeH3('Budget Table (With Yearly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateYears(), false, false, false, false, 'L');
        $this->Ln(2);
        $this->writeH3('Expenses');
		$this->Ln(1);
        $this->writeHTML($html_y_expenses, false, false, false, false, 'L');
        $this->Ln(2);
        $this->writeH3('Major Purchases');
		$this->Ln(1);
        $this->writeHTML($html_y_purchases, false, false, false, false, 'L');
        $this->Ln(1);

        $budget_graph = new BudgetGraphService($this->business_plan, $budget_calculator);
        $graphs = $budget_graph->getGraphs();

        $this->renderGraphs([
            $graphs['monthly_expenses'], 
            $graphs['yearly_expenses']
        ]);

        $this->graphs += $graphs;
    }

    protected function renderFundings($fund_calculator)
    {
        $loans = $fund_calculator->getLoans();
        $investments = $fund_calculator->getInvestments();
        $monthly_total_loans = $fund_calculator->getLoansMonthlyTotals();
        $monthly_total_investments = $fund_calculator->getInvestmentsMonthlyTotals();
        $yearly_total_loans = $fund_calculator->getLoansYearlyTotals();
        $yearly_total_investments = $fund_calculator->getInvestmentsYearlyTotals();
        
        $html_loans = "<table>";
        $html_investments = "<table>";
        $html_y_loans = "<table>";
        $html_y_investments = "<table>";
        
        foreach ($loans as $row) {
            $html_loans .= '<tr style="font-size: 12px; color: #000000;"><td>' . $row->loan_invest_name . '</td>';
            $html_y_loans .= '<tr style="font-size: 12px; color: #000000;"><td colspan="2">' . $row->loan_invest_name . '</td>';

            for ($index = 0; $index < 12; $index++) {
                $key = "limr_month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                $value = $row->$key;

                $html_loans .= '<td style="text-align: right;">' . $fund_calculator->formatNumberDisplay($value, 0) . '</td>';
            }

            for ($index = 0; $index < 3; $index++) {
                $html_y_loans .= '<td style="text-align: right;" colspan="2">' . $fund_calculator->formatNumberDisplay($row->totals[$index], 0) . '</td>';
            }
            
            $html_loans .= '</tr>';
            $html_y_loans .= '<td colspan="5"></td></tr>';
        }

        $html_loans .= '<tr><td>Total</td>';

        for ($x = 0; $x < 12; $x++) {
            $html_loans .= '<td style="text-align: right;">' . $fund_calculator->formatNumberDisplay($monthly_total_loans[$x], 0) . '</td>';
        }

        $html_loans .= '</tr>';

        $html_y_loans .= '<tr><td colspan="2">Total</td>';

        for ($x = 0; $x < 3; $x++) {
            $html_y_loans .= '<td style="text-align: right;" colspan="2">' . $fund_calculator->formatNumberDisplay($yearly_total_loans[$x], 0) . '</td>';
        }

        $html_y_loans .= '<td colspan="5"></td></tr>';

        foreach ($investments as $row) {
            $html_investments .= '<tr style="font-size: 12px; color: #000000;"><td>' . $row->loan_invest_name . '</td>';
            $html_y_investments .= '<tr style="font-size: 12px; color: #000000;"><td colspan="2">' . $row->loan_invest_name . '</td>';

            for ($index = 0; $index < 12; $index++) {
                $key = "limr_month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                $value = $row->$key;

                $html_investments .= '<td style="text-align: right;">' . $fund_calculator->formatNumberDisplay($value, 0) . '</td>';
            }

            for ($index = 0; $index < 3; $index++) {
                $html_y_investments .= '<td style="text-align: right;" colspan="2">' . $fund_calculator->formatNumberDisplay($row->totals[$index], 0) . '</td>';
            }
            
            $html_investments .= '</tr>';
            $html_y_investments .= '<td colspan="5"></td></tr>';
        }

        $html_investments .= '<tr><td>Total</td>';

        for ($x = 0; $x < 12; $x++) {
            $html_investments .= '<td style="text-align: right;">' . $fund_calculator->formatNumberDisplay($monthly_total_investments[$x], 0) . '</td>';
        }

        $html_investments .= '</tr>';

        $html_y_investments .= '<tr><td colspan="2">Total</td>';

        for ($x = 0; $x < 3; $x++) {
            $html_y_investments .= '<td style="text-align: right;" colspan="2">' . $fund_calculator->formatNumberDisplay($yearly_total_investments[$x], 0) . '</td>';
        }

        $html_y_investments .= '<td colspan="5"></td></tr>';

        $html_loans .= "</table>";
        $html_investments .= "</table>";
        $html_y_loans .= "</table>";
        $html_y_investments .= "</table>";
        
        $this->renderPageTitle('Loan and Investments');
        $this->Ln(1);
		//data is calculated in renderSalesForecast function call          
		$this->writeH3('Loan and Investments Table (With Monthly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateMonths(), false, false, false, false, 'L');
        $this->Ln(2);
        $this->writeH3('Loans');
		$this->Ln(1);
        $this->writeHTML($html_loans, false, false, false, false, 'L');
        $this->Ln(2);
        $this->writeH3('Investments');
		$this->Ln(1);
        $this->writeHTML($html_investments, false, false, false, false, 'L');
        $this->Ln(1);
        
        $this->Ln(4);
        $this->writeH3('Loan and Investments Table (With Yearly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateYears(), false, false, false, false, 'L');
        $this->Ln(2);
        $this->writeH3('Loans');
		$this->Ln(1);
        $this->writeHTML($html_y_loans, false, false, false, false, 'L');
        $this->Ln(2);
        $this->writeH3('Investments');
		$this->Ln(1);
        $this->writeHTML($html_y_investments, false, false, false, false, 'L');
        $this->Ln(1);
    }

    protected function renderProfitAndLoss($fs_calculator, $sales_calculator, $budget_calculator)
    {
        $monthly_gross_margin = $sales_calculator->getMonthlyGrossMargin();
        $monthly_total_expenses = $budget_calculator->getExpensesMonthlyTotals();
        $monthly_totals = $fs_calculator->getMonthlyTotals();
        
        $html = "<table>";
        
        $html_gross = '<tr><td>Gross Margin</td>';
        $html_expenses = '<tr><td>Total Overheads</td>';
        $html_interest =  '<tr><td>Interest Incurred</td>';
        $html_depreciation =  '<tr><td>Depreciation and Amortization</td>';
        $html_pre_tax_profit =  '<tr><td>Pre Tax Profit</td>';
        $html_net_percent =  '<tr><td>Net Profit / Sales</td>';
        $html_tax =  '<tr><td>Income Tax</td>';
        $html_dividends =  '<tr><td>Dividends</td>';
        
        for ($x = 0; $x < 12; $x++) {
            $html_gross .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_gross_margin[$x], 0) . '</td>';
            $html_expenses .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_total_expenses[$x], 0) . '</td>';
            $html_interest .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_totals['interest_incurred'][$x], 0) . '</td>';
            $html_depreciation .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_totals['depreciation'][$x], 0) . '</td>';
            $html_pre_tax_profit .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_totals['pre_tax_profit'][$x], 0) . '</td>';
            $html_net_percent .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_totals['net_profit_percent'][$x], 0, '', '%') . '</td>';
            $html_tax .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_totals['income_tax'][$x], 0) . '</td>';
            $html_dividends .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_totals['dividends'][$x], 0) . '</td>';
            
        }

        $html_gross .= '</tr>';
        $html_expenses .= '</tr>';
        $html_interest .= '</tr>';
        $html_depreciation .= '</tr>';
        $html_pre_tax_profit .= '</tr>';
        $html_net_percent .= '</tr>';
        $html_tax .= '</tr>';
        $html_dividends .= '</tr>';
        

        $html .= $html_gross . $html_expenses . $html_interest . $html_depreciation . $html_pre_tax_profit . $html_net_percent . $html_tax . $html_dividends . "</table>";

        $yearly_data = $fs_calculator->getProfitAndLossYearlyData();

        $html_y = "<table>";
        
        $html_y_gross = '<tr><td colspan="2">Gross Margin</td>';
        $html_y_expenses = '<tr><td colspan="2">Total Overheads</td>';
        $html_y_interest =  '<tr><td colspan="2">Interest Incurred</td>';
        $html_y_depreciation =  '<tr><td colspan="2">Depreciation and Amortization</td>';
        $html_y_pre_tax_profit =  '<tr><td colspan="2">Pre Tax Profit</td>';
        $html_y_net_percent =  '<tr><td colspan="2">Net Profit / Sales</td>';
        $html_y_tax =  '<tr><td colspan="2">Income Tax</td>';
        $html_y_dividends =  '<tr><td colspan="2">Dividends</td>';
        
        for ($x = 0; $x < 3; $x++) {
            $html_y_gross .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['gross_margin'][$x], 0) . '</td>';
            $html_y_expenses .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['operating_expenses'][$x], 0) . '</td>';
            $html_y_interest .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['interest_incurred'][$x], 0) . '</td>';
            $html_y_depreciation .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['depreciation'][$x], 0) . '</td>';
            $html_y_pre_tax_profit .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['pre_tax_profit'][$x], 0) . '</td>';
            $html_y_net_percent .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['net_profit_percent'][$x], 0, '', '%') . '</td>';
            $html_y_tax .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['income_taxes'][$x], 0) . '</td>';
            $html_y_dividends .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data['dividends'][$x], 0) . '</td>';
        }

        $html_y_gross .= '<td colspan="5"></td></tr>';
        $html_y_expenses .= '<td colspan="5"></td></tr>';
        $html_y_interest .= '<td colspan="5"></td></tr>';
        $html_y_depreciation .= '<td colspan="5"></td></tr>';
        $html_y_pre_tax_profit .= '<td colspan="5"></td></tr>';
        $html_y_net_percent .= '<td colspan="5"></td></tr>';
        $html_y_tax .= '<td colspan="5"></td></tr>';
        $html_y_dividends .= '<td colspan="5"></td></tr>';
        
        $html_y .= $html_y_gross . $html_y_expenses . $html_y_interest . $html_y_depreciation . $html_y_pre_tax_profit . $html_y_net_percent . $html_y_tax . $html_y_dividends . "</table>";
        
        $this->renderPageTitle('Profit and Loss Statement');
        $this->Ln(1);
		//data is calculated in renderSalesForecast function call          
		$this->writeH3('Profit and Loss Statement (With Monthly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateMonths(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeHTML($html, false, false, false, false, 'L');
        $this->Ln(5);
        $this->writeH3('Profit and Loss Statement (With Yearly Detail)');
        $this->Ln(3);
        $this->writeHTML($this->generateYears(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeHTML($html_y, false, false, false, false, 'L');

        $this->renderGraphs([
            $this->graphs['monthly_sales'], 
            $this->graphs['monthly_expenses'], 
            $this->graphs['monthly_gross_margin'], 
            $this->graphs['yearly_sales'], 
            $this->graphs['yearly_expenses'],
            $this->graphs['yearly_gross_margin']
        ]);
    }

    protected function renderBalanceSheet($fs_calculator)
    {
        $yearly_data = $fs_calculator->getBalanceSheetYearlyData();
        $monthly_data = $fs_calculator->getBalanceSheetMonthlyData();
        
        $ar_monthly_html = [
            '<tr><td>Cash</td>',
            '<tr><td>Accounts Receivable</td>',
            '<tr><td>Total Current Assets</td>',
            '<tr><td>Long Term Assets</td>',
            '<tr><td>Accumulated Depreciation</td>',
            '<tr><td>Total Long-Term Assets</td>',
            '<tr><td>Total Assets</td>',
            '<tr><td>Accounts Payable</td>',
            '<tr><td>Total Current Liabilities</td>',
            '<tr><td>Long-Term Debt</td>',
            '<tr><td>Total Liabilities</td>',
            '<tr><td>Paid-in-capital</td>',
            '<tr><td>Retained Earnings</td>',
            '<tr><td>Earnings</td>',
            '<tr><td>Total Owner Equity</td>',
            '<tr><td>Total Liabilities & Equity</td>'
        ];

        $ar_yearly_html = [
            '<tr><td colspan="2">Cash</td>',
            '<tr><td colspan="2">Accounts Receivable</td>',
            '<tr><td colspan="2">Total Current Assets</td>',
            '<tr><td colspan="2">Long Term Assets</td>',
            '<tr><td colspan="2">Accumulated Depreciation</td>',
            '<tr><td colspan="2">Total Long-Term Assets</td>',
            '<tr><td colspan="2">Total Assets</td>',
            '<tr><td colspan="2">Accounts Payable</td>',
            '<tr><td colspan="2">Total Current Liabilities</td>',
            '<tr><td colspan="2">Long-Term Debt</td>',
            '<tr><td colspan="2">Total Liabilities</td>',
            '<tr><td colspan="2">Paid-in-capital</td>',
            '<tr><td colspan="2">Retained Earnings</td>',
            '<tr><td colspan="2">Earnings</td>',
            '<tr><td colspan="2">Total Owner Equity</td>',
            '<tr><td colspan="2">Total Liabilities & Equity</td>'
        ];

        $keys = array_keys($yearly_data);
        $count = count($keys);

        for ($x = 0; $x < 12; $x++) {
            for ($y = 0; $y < $count; $y++) {
                $ar_monthly_html[$y] .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($monthly_data[$keys[$y]][$x], 0) . '</td>';

                if ($x < 3) {
                    $ar_yearly_html[$y] .= '<td style="text-align: right;" colspan="2">' . $fs_calculator->formatNumberDisplay($yearly_data[$keys[$y]][$x], 0) . '</td>';    
                }
            }
        }

        $monthly_html = $yearly_html = '<table>';
        $count = count($ar_yearly_html);

        for ($x = 0; $x < $count; $x++) {
            $monthly_html .= $ar_monthly_html[$x] . '</tr>';
            $yearly_html .= $ar_yearly_html[$x] . '<td colspan="5"></td></tr>';
        }

        $monthly_html .= '</table>';
        $yearly_html .= '</table>';

        $this->renderPageTitle('Balance Sheet');
        $this->Ln(1);
		$this->writeH3('Balance Sheet Table (With Monthly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateMonths(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeHTML($monthly_html, false, false, false, false, 'L');
        $this->Ln(5);
        $this->writeH3('Balance Sheet Table (With Yearly Detail)');
        $this->Ln(3);
        $this->writeHTML($this->generateYears(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeHTML($yearly_html, false, false, false, false, 'L');
    }

    protected function renderCashFlow($fs_calculator)
    {
        $yearly_data = $fs_calculator->getCashFlowYearlyData();
        $monthly_data = $fs_calculator->getCashFlowMonthlyData();
        
        $ar_monthly_html = [
            '<tr><td>Net Profit After Tax and Profit Distribution</td>',
            '<tr><td>Depreciation and Amortization</td>',
            '<tr><td>Change in Accounts Receivable</td>',
            '<tr><td>Change in Accounts Payable</td>',
            '<tr><td>Net Cash Flow From Operations</td>',
            '<tr><td>Assets Purchased or Sold</td>',
            '<tr><td>Investments Received</td>',
            '<tr><td>Change in Long-Term Debt</td>',
            '<tr><td>Net Cash Flow From Investing & Financing</td>',
            '<tr><td>Cash at Beginning of Period</td>',
            '<tr><td>Net Change in Cash</td>',
            '<tr><td>Cash at End of Period</td>'
        ];

        $ar_yearly_html = [
            '<tr><td colspan="2">Net Profit After Tax and Profit Distribution</td>',
            '<tr><td colspan="2">Depreciation and Amortization</td>',
            '<tr><td colspan="2">Change in Accounts Receivable</td>',
            '<tr><td colspan="2">Change in Accounts Payable</td>',
            '<tr><td colspan="2">Net Cash Flow From Operations</td>',
            '<tr><td colspan="2">Assets Purchased or Sold</td>',
            '<tr><td colspan="2">Investments Received</td>',
            '<tr><td colspan="2">Change in Long-Term Debt</td>',
            '<tr><td colspan="2">Net Cash Flow From Investing & Financing</td>',
            '<tr><td colspan="2">Cash at Beginning of Period</td>',
            '<tr><td colspan="2">Net Change in Cash</td>',
            '<tr><td colspan="2">Cash at End of Period</td>'
        ];

        $keys = array_keys($yearly_data);
        $count = count($keys);

        for ($x = 0; $x < 12; $x++) {
            for ($y = 0; $y < $count; $y++) {
                $value = $keys[$y] == 'assets_purchased_or_sold' ? ($monthly_data[$keys[$y]][$x] * -1) : $monthly_data[$keys[$y]][$x];
                $ar_monthly_html[$y] .= '<td style="text-align: right;">' . $fs_calculator->formatNumberDisplay($value, 0) . '</td>';

                if ($x < 3) {
                    $value = $keys[$y] == 'assets_purchased_or_sold' ? ($yearly_data[$keys[$y]][$x] * -1) : $yearly_data[$keys[$y]][$x];
                    $ar_yearly_html[$y] .= '<td style="text-align: right;" colspan="2">' .   $fs_calculator->formatNumberDisplay($value, 0) . '</td>';    
                }
            }
        }

        $monthly_op_html = $yearly_op_html = $monthly_if_html = $yearly_if_html = '<table>';
        $count = count($ar_yearly_html);

        for ($x = 0; $x < $count; $x++) {
            if ($x < 5) {
                $monthly_op_html .= $ar_monthly_html[$x] . '</tr>';
                $yearly_op_html .= $ar_yearly_html[$x] . '<td colspan="5"></td></tr>';
            }
            else {
                $monthly_if_html .= $ar_monthly_html[$x] . '</tr>';
                $yearly_if_html .= $ar_yearly_html[$x] . '<td colspan="5"></td></tr>';
            }
        }

        $monthly_op_html .= '</table>';
        $yearly_op_html .= '</table>';
        $monthly_if_html .= '</table>';
        $yearly_if_html .= '</table>';

        $this->renderPageTitle('Cash Flow Statement');
        $this->Ln(1);
		$this->writeH3('Cash Flow Statement (With Monthly Detail)');
		$this->Ln(3);
        $this->writeHTML($this->generateMonths(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Operations');
        $this->Ln(1);
        $this->writeHTML($monthly_op_html, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Investing and Finance');
        $this->Ln(1);
        $this->writeHTML($monthly_if_html, false, false, false, false, 'L');
        $this->Ln(5);
        $this->writeH3('Cash Flow Statement (With Yearly Detail)');
        $this->Ln(3);
        $this->writeHTML($this->generateYears(), false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Operations');
        $this->Ln(1);
        $this->writeHTML($yearly_op_html, false, false, false, false, 'L');
        $this->Ln(1);
        $this->writeH3('Investing and Finance');
        $this->Ln(1);
        $this->writeHTML($yearly_if_html, false, false, false, false, 'L');
    }

    protected function renderPageTitle($title)
    {
        $this->writeSubHeader($title);
    }

    protected function renderPageContent($content)
    {
        $content = trim($content);

        if (!empty($content)) {
            $content = '<p style="font-size: 1px;">&nbsp;</p>' . $content;
        }

        $this->writeHTML($content, false, false, false, false, 'L');
        $this->Ln(4);
    }

    protected function writeHeader($txt, $orientation = 'P') 
    {
		$this->AddPage($orientation);		
		$this->Bookmark($txt, 0, 0, '', '', array(93,0,0));
		$this->SetFont('rockb', '', 20, '', true);
		$this->setTextColor(0, 0, 0);
		$this->SetX($this->lMargin - 1);
		$this->Cell(0, 0, $txt, 0, 1, 'L');
	}
    
    protected function writeSubHeader($txt) 
    {
		$this->Bookmark($txt, 1, 0, '', '', array(0,0,0));
		$this->SetFont('rock', '', 16, '', true);
		$this->setTextColor(93, 0, 0);
		$this->SetX($this->lMargin - 1);
		$this->Cell(0, 5, $txt, 0, 1, 'L');
		$this->SetFont('rockl', '', 10, '', true);
		$this->setTextColor(0, 0, 0);
	}

    protected function writeH3($txt) {				
		$this->Bookmark($txt, 2, 0, '', '', array(0,0,0));
		$this->SetFont('rock', '', 10, '', true);
		$this->setTextColor(0, 0, 0);
		$this->SetX($this->lMargin-1);
		$this->Cell(0, 5, $txt, 0, 1, 'L');
		$this->SetFont('rockl', '', 10, '', true);
		$this->setTextColor(0, 0, 0);
	}

    protected function renderGraphs($graphs)
    {
        foreach ($graphs as $graph) {
            $this->addPage('L');
            $this->Ln(10);
            $this->writeH3($graph['name']);
            $this->Image($graph['path'], 15, 60, 175, 100, 'PNG',null ,null ,2);    
        }
    }

    protected function generateMonths() 
    {
        $months = $this->business_plan->getStartMonths();
        $html_months = '<table class="table" cellspacing="1" cellpadding="1"><tr style="font-size: 12px; color: #000000;"><td></td>';

        foreach ($months as $month) {
            $html_months .= '<td style="text-align: right; font-style: timesB;"><b>' . $month . '</b></td>';
        }
        
        $html_months .= '</tr></table>';

        return $html_months;
    }

    protected function generateYears()
    {
        $start_year = $this->business_plan->getStartYear();
        $html_years = '<table class="table" cellspacing="1" cellpadding="1"><tr style="font-size: 12px; color: #000000;"><td colspan="2"></td>';
     
        for ($x = 0; $x < 3; $x++) {
            $html_years .= '<td style="text-align: right; font-style: timesB;" colspan="2"><b>FY' . ($start_year + $x) . '</b></td>';
        }
        
        $html_years .= '<td colspan="5"></td></tr></table>';

        return $html_years;
    }

    /**
	 * Output a Table of Content Index (TOC).
	 * This method must be called after all Bookmarks were set.
	 * Before calling this method you have to open the page using the addTOCPage() method.
	 * After calling this method you have to call endTOCPage() to close the TOC page.
	 * You can override this method to achieve different styles.
	 * @param $page (int) page number where this TOC should be inserted (leave empty for current page).
	 * @param $numbersfont (string) set the font for page numbers (please use monospaced font for better alignment).
	 * @param $filler (string) string used to fill the space between text and page number.
	 * @param $toc_name (string) name to use for TOC bookmark.
	 * @param $style (string) Font style for title: B = Bold, I = Italic, BI = Bold + Italic.
	 * @param $color (array) RGB color array for bookmark title (values from 0 to 255).
	 * @public
	 * @author Nicola Asuni
	 * @since 4.5.000 (2009-01-02)
	 * @see addTOCPage(), endTOCPage(), addHTMLTOC()
	 */
	public function addTOC($page='', $numbersfont='', $filler='.', $toc_name='TOC', $style='', $color=array(0,0,0)) {
		$fontsize = $this->FontSizePt;
		$fontfamily = $this->FontFamily;
		$fontstyle = $this->FontStyle;
		$w = $this->w - $this->lMargin - $this->rMargin;
		$spacer = $this->GetStringWidth(chr(32)) * 4;
		$lmargin = $this->lMargin;
		$rmargin = $this->rMargin;
		$x_start = $this->GetX();
		$page_first = $this->page;
		$current_page = $this->page;
		$page_fill_start = false;
		$page_fill_end = false;
		$current_column = $this->current_column;
		if (TCPDF_STATIC::empty_string($numbersfont)) {
			$numbersfont = $this->default_monospaced_font;
		}
		if (TCPDF_STATIC::empty_string($filler)) {
			$filler = ' ';
		}
		if (TCPDF_STATIC::empty_string($page)) {
			$gap = ' ';
		} else {
			$gap = '';
			if ($page < 1) {
				$page = 1;
			}
		}
		$this->SetFont($numbersfont, $fontstyle, $fontsize);
		$numwidth = $this->GetStringWidth('00000');
		$maxpage = 0; //used for pages on attached documents
		foreach ($this->outlines as $key => $outline) {
			// check for extra pages (used for attachments)
			
			//include only up to level 2 bookmarks in table of contents
			if ($outline['l']== 2) {
				continue;
			} 
			
			
			if (($this->page > $page_first) AND ($outline['p'] >= $this->numpages)) {
				$outline['p'] += ($this->page - $page_first);
			}
			if ($this->rtl) {
				$aligntext = 'R';
				$alignnum = 'L';
			} else {
				$aligntext = 'L';
				$alignnum = 'R';
			}
			if ($outline['l'] == 0) {
				$this->SetFont('rock', $outline['s'], 15);
			} else {
				$this->SetFont('rockl', $outline['s'], 10);
			}
			$this->SetTextColorArray($outline['c']);
			// check for page break
			$this->checkPageBreak(2 * $this->getCellHeight($this->FontSize));
			// set margins and X position
			if (($this->page == $current_page) AND ($this->current_column == $current_column)) {
				$this->lMargin = $lmargin;
				$this->rMargin = $rmargin;
			} else {
				if ($this->current_column != $current_column) {
					if ($this->rtl) {
						$x_start = $this->w - $this->columns[$this->current_column]['x'];
					} else {
						$x_start = $this->columns[$this->current_column]['x'];
					}
				}
				$lmargin = $this->lMargin;
				$rmargin = $this->rMargin;
				$current_page = $this->page;
				$current_column = $this->current_column;
			}
						
			
			$this->SetX($x_start);
			//$indent = ($spacer * $outline['l']);
			$indent = 0;
			
			if ($this->rtl) {
				$this->x -= $indent;
				$this->rMargin = $this->w - $this->x;
			} else {
				$this->x += $indent;
				$this->lMargin = $this->x;
			}
			$link = $this->AddLink();
			$this->SetLink($link, $outline['y'], $outline['p']);
			// write the text
			if ($this->rtl) {
				$txt = ' '.$outline['t'];
			} else {
				$txt = $outline['t'].' ';
			}
									
			if ($outline['l']== 0) {
				$this->Ln(10);
			} 
			
			$this->Write(0, $txt, $link, false, $aligntext, false, 0, false, false, 0, $numwidth, '');
			if ($this->rtl) {
				$tw = $this->x - $this->lMargin;
			} else {
				$tw = $this->w - $this->rMargin - $this->x;
			}
						
			//$this->SetFont('rock', $fontstyle, $fontsize);
						
			if (TCPDF_STATIC::empty_string($page)) {
				$pagenum = $outline['p'];
			} else {
				// placemark to be replaced with the correct number
				$pagenum = '{#'.($outline['p']).'}';
				if ($this->isUnicodeFont()) {
					$pagenum = '{'.$pagenum.'}';
				}
				$maxpage = max($maxpage, $outline['p']);
			}
			$fw = ($tw - $this->GetStringWidth($pagenum.$filler));
			$wfiller = $this->GetStringWidth($filler);
			if ($wfiller > 0) {
				$numfills = floor($fw / $wfiller);
			} else {
				$numfills = 0;
			}
			if ($numfills > 0) {
				$rowfill = str_repeat($filler, $numfills);
			} else {
				$rowfill = '';
			}
			if ($this->rtl) {
				$pagenum = $pagenum.$gap.$rowfill;
			} else {
				$pagenum = $rowfill.$gap.$pagenum;
			}
			// write the number
			
			if ($outline['l'] != 0) {
				$tw += 2;
			} 
			
			$tw -= 3;

			$this->Cell($tw, 0, $pagenum, 0, 1, $alignnum, 0, $link, 0);
		}
		$page_last = $this->getPage();
		$numpages = ($page_last - $page_first + 1);
		// account for booklet mode
		if ($this->booklet) {
			// check if a blank page is required before TOC
			$page_fill_start = ((($page_first % 2) == 0) XOR (($page % 2) == 0));
			$page_fill_end = (!((($numpages % 2) == 0) XOR ($page_fill_start)));
			if ($page_fill_start) {
				// add a page at the end (to be moved before TOC)
				$this->addPage();
				++$page_last;
				++$numpages;
			}
			if ($page_fill_end) {
				// add a page at the end
				$this->addPage();
				++$page_last;
				++$numpages;
			}
		}
		$maxpage = max($maxpage, $page_last);
		
		//offset to subtract to cater for the cover and table of contents 
		$pagenumoffset = ($maxpage-$this->numnormalpages) + 1; //+ 1 for the cover
		
		
		if (!TCPDF_STATIC::empty_string($page)) {
			for ($p = $page_first; $p <= $page_last; ++$p) {
				// get page data
				$temppage = $this->getPageBuffer($p);
				for ($n = 1; $n <= $maxpage; ++$n) {
					// update page numbers
					$a = '{#'.$n.'}';
					// get page number aliases
					$pnalias = $this->getInternalPageNumberAliases($a);
					// calculate replacement number
					if (($n >= $page) AND ($n <= $this->numpages)) {
						$np = $n + $numpages;
					} else {
						$np = $n;
					}
					
					//adjust with offset for the cover ang table of contents pages
					//$na = $na - $pagenumoffset;
					
					$na = TCPDF_STATIC::formatTOCPageNumber(($this->starting_page_number + $np - 1 - $pagenumoffset));
					$nu = TCPDF_FONTS::UTF8ToUTF16BE($na, false, $this->isunicode, $this->CurrentFont);
					
					
					
					
					// replace aliases with numbers
					foreach ($pnalias['u'] as $u) {
						$sfill = str_repeat($filler, max(0, (strlen($u) - strlen($nu.' '))));
																		
						if ($this->rtl) {
							$nr = $nu.TCPDF_FONTS::UTF8ToUTF16BE(' '.$sfill, false, $this->isunicode, $this->CurrentFont);
						} else {
							$nr = TCPDF_FONTS::UTF8ToUTF16BE($sfill.' ', false, $this->isunicode, $this->CurrentFont).$nu;
							
						}
						$temppage = str_replace($u, $nr, $temppage);
					}
					foreach ($pnalias['a'] as $a) {
						$sfill = str_repeat($filler, max(0, (strlen($a) - strlen($na.' '))));
												
						
						if ($this->rtl) {
							$nr = $na.' '.$sfill;
						} else {
							$nr = $sfill.' '.$na;
						}
												
						$temppage = str_replace($a, $nr, $temppage);
						
					}
				}
				// save changes
				$this->setPageBuffer($p, $temppage);
			}
			// move pages
			$this->Bookmark($toc_name, 0, 0, $page_first, $style, $color);
			if ($page_fill_start) {
				$this->movePage($page_last, $page_first);
			}
			for ($i = 0; $i < $numpages; ++$i) {
				$this->movePage($page_last, $page);
			}
		}
	}
}
