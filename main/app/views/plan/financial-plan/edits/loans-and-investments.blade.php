@section('content')
<div id="notification" class="col-xs-12" style="margin-bottom: 20px; padding: 0px;">
    @if(Session::get('message'))
        <div class="alert alert-dismissable alert-success" style="font-size: 14px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b>{{ Session::get('message') }}</b>
        </div>
    @endif
</div>

<div class="col-xs-12 financial-plan-editor">
    <legend>Loans and Investments Table</legend>
    <div class="col-xs-12" style="padding: 0px;">
        <a class="backtoplan back-to-outline" href="{{ url('plan/financial-plan/loans-and-investments/' . $business_plan->id) }}" >Back to Outline</a>
    </div>
    <div class="col-xs-12" style="padding: 15px 0px;">
        <div class="tableBuilder">
            <div class="pages">
                <div class="page">
                    <div class="page-body">
                        <div class="intro-block ">
                            <div class="widget-content">
                                <h3>Are you planning to get loans, investments, or other funding?</h3>
                                <p>Adding funding to your plan is easy. Just walk through the steps below. If you already know the details of your funding sources, the table builder will automatically calculate your payments and update the financials appropriately. Not sure yet where the money is going to come from? That's fine too. Just choose "Other" as the funding type, then enter the amounts you need and a rough guess at the payback details. Beyond funding, this table builder is also useful for adding loans to pay for major purchases, such as a vehicle or capital improvement.</p>
                                <p>If you are not planning on any loans or other funding, you can use the Chapter Setup view to remove this section from your plan. You can always add it back if your needs change later.</p>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding: 0px;" id="loans-list">
                            @foreach ($fundings as $row)
                                <div class="each-entry col-xs-12">
                                    <div class="each-entry-title col-xs-12">{{ $row->loan_invest_name}}<span style="font-size: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->type_of_funding }}
                                    @if ($row->type_of_funding == 'Loan')
                                    at {{ number_format($row->loan_invest_interest_rate, 2) }}% Interest
                                    @endif
                                    </span></div>
                                    
                                    <?php 
                                    $months_data_html = "";
                                    $months_display_html = "";
                                    $years_data_html = "";
                                    $years_display_html = "";
                                    $year_totals = explode(",", $row->totals); 
                                    
                                    foreach ($months as $index => $month) {
                                        $key = "limr_month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                                        $value = $row->$key;
                                        $months_data_html .= (empty($months_data_html) ? '' : ', ') . '"' . $index . '" : "' . $value . '"';
                                        $months_display_html .= '
                                            <div class="col-xs-2" style="padding: 0 5px;">
                                                <p class="each-entry-month" style="text-align: center;">' . $month . '</p>
                                                <p class="each-entry-value" style="text-align: center;">' . $value . '</p>
                                            </div>';
                                    }

                                    foreach ($year_totals as $index => $total) {
                                        $years_data_html .= (empty($years_data_html) ? '' : ', ') . '"' . $index . '" : "' . $total . '"';
                                        $years_display_html .= '<div class="col-xs-2" style="padding: 0 5px;">
                                            <p class="each-entry-month" style="text-align: center;">FY' . ($start_year + $index) . '</p>
                                            <p class="each-entry-value" style="text-align: center;">' . $total . '</p>
                                        </div>';
                                    }

                                    ?>

                                    <div class="click-to-edit" style="margin-right: -15px;  margin-top: -34px;">
                                        <div class="tuck">
                                            <a href="{{ url('plan/financial-plan-loans-and-investments/edit/' . $row->li_id) }}" class="edit-loan" data-li_id="{{ $row->li_id }}" data-loan_invest_name="{{ $row->loan_invest_name }}" data-type_of_funding="{{ $row->type_of_funding }}" data-loan_invest_interest_rate="{{ $row->loan_invest_interest_rate }}" data-loan_invest_years_to_pay="{{ $row->loan_invest_years_to_pay }}" data-loan_invest_pays_per_years="{{ $row->loan_invest_pays_per_years }}" data-months='{ {{ $months_data_html }} }' data-years='{ {{ $years_data_html }} }'>
                                                <div class="flag">
                                                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                        {{ $months_display_html }}                                    
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                        {{ $years_display_html }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                <a href="#" class="btn btn-primary" id="add-loan">Add a Funding Source</a>
                            </div>
                        </div>
                        <div class="col-xs-12" id="edit-loan" style="padding: 0px; display: none;">
                            <form id="loan-form" action="{{ asset('plan/financial-plan-loans-and-investments') }}" method="POST">
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <input name="li_id" value="" type="hidden"/>
                                
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Fill in the details for this funding source</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%;">
                                            <div class="num"> 1</div>
                                            <h4 class="label">What do you want to call this funding source?</h4>
                                            <div class="step-inner form-group"  style="width: 100%;">
                                                <input type="text" name="loan_invest_name" value="Test 1" maxlength="255" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 2</div>
                                            <h4 class="label">What type of funding is this?</h4>
                                            <div class="step-inner form-group">
                                                <select name="type_of_funding" class="entry-period form-control" size="1" style="float: left; width: 200px;">	
                                                    <option value="Loan">Loan</option>
                                                    <option value="Investment">Investment</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 3</div>
                                            <h4 class="label">How much funding do you expect to receive and when?</h4>
                                            <div class="step-inner form-group">
                                                @foreach ($months as $index => $month)
                                                <div class="col-xs-2">
                                                    <p>{{ $month }}</p>
                                                    <p><input style="width: 70px;" type="text" name="months[{{ $index }}]" value="" maxlength="11" class="form-control"></p>
                                                </div>
                                                @endforeach
                                                <?php $start_year = $business_plan->getStartYear(); ?>
                                                <div class="col-xs-2">
                                                    <p>FY{{ $start_year }}</p>
                                                    <p><input style="width: 70px;" type="text" name="years[0]" value="" maxlength="11" class="form-control" disabled></p>
                                                </div>
                                                <div class="col-xs-2">
                                                    <p>FY{{ $start_year + 1 }}</p>
                                                    <p><input style="width: 70px;" type="text" name="years[1]" value="" maxlength="11" class="form-control"></p>
                                                </div>
                                                <div class="col-xs-2">
                                                    <p>FY{{ $start_year + 2 }}</p>
                                                    <p><input style="width: 70px;" type="text" name="years[2]" value="" maxlength="11" class="form-control"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 100%; float: left;" id="loan_funding_fields">
                                        <div class="expense-budget-entryMethod">
                                            <div class="step expense-name">
                                                <div class="num"> 4</div>
                                                <h4 class="label">What interest rate do you expect to pay for this funding?</h4>
                                                <div class="step-inner form-group">
                                                    <input type="text" name="loan_invest_interest_rate" value="" maxlength="11" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="expense-budget-entryMethod">
                                            <div class="step expense-name">
                                                <div class="num"> 5</div>
                                                <h4 class="label">How many years do you expect to pay for this funding?</h4>
                                                <div class="step-inner form-group">
                                                    <input type="text" name="loan_invest_years_to_pay" value="" maxlength="11" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="expense-budget-entryMethod">
                                            <div class="step expense-name">
                                                <div class="num"> 6</div>
                                                <h4 class="label">How many payments do you expect to do in a year?</h4>
                                                <div class="step-inner form-group">
                                                    <input type="text" name="loan_invest_pays_per_years" value="" maxlength="11" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-loan">Save</button>
                                    <a href="{{ url('plan/financial-plan-loans-and-investments-delete') }}"  class="btn btn-danger" id="delete-loan">Delete</a>
                                    <a href="#" class="btn btn-default" id="cancel-loan">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div><!--end .page-body-->
                </div><!--end of page-->
            </div><!--end of pages-->
        </div><!--end .tableBuilder-->
    </div> <!--end no name div -->
    <legend></legend>
    <div class="col-xs-6" style="padding: 0px;">
        <div class="col-xs-12" style="padding: 0px; margin-top: 15px; display: none;" id="save-budget-message">
            <img style="width: 30px; margin-right: 10px;" src="{{ asset('assets/img/loading.gif') }}"/>
            <span style="font-size: 15px;">Saving your changes. Please don't close the dialog box</span>
        </div>
        <div class="col-xs-12" style="padding: 15px; text-align: left; color: #3c763d; font-size: 15px; display: none;" id="save-budget-message-success">
        </div>
    </div>
    <div class="col-xs-6" style="padding: 10px 0px; text-align: right;">
        <a class="btn btn-default back-to-outline" href="{{ url('plan/financial-plan/loans-and-investments/' . $business_plan->id) }}" >I'm Done</a>
    </div>
</div> <!-- end row -->

@stop