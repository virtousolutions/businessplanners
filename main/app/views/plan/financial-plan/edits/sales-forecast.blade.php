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
    <legend>Sales Forecast Table</legend>
    <div class="col-xs-12" style="padding: 0px;">
        <a class="backtoplan back-to-outline" href="{{ url('plan/financial-plan/sales-forecast/' . $business_plan->id) }}" >Back to Outline</a>
    </div>
    <div class="col-xs-12" style="padding: 15px 0px;">
        <div class="tableBuilder">
            <div class="pages">
                <div class="page">
                    <div class="page-body">
                        
                        <div class="col-xs-12" style="padding: 0px;" id="sales-list">
                            <div class="intro-block ">
                                <div class="widget-content">
                                    <h3>What do you sell?</h3>
                                    <p>Break down what you sell into groups of products or services. You might group offerings together based on price, how you provide them, or which kind of customer buys them. For example, a fitness center might separate sales of group memberships, individual memberships, and personal training services. A shoe store might list sneakers, dress shoes, children's shoes, and waterproof sealer.</p>
                                    <p>Keep this list short. Trying to list dozens of individual products will make your forecast difficult to predict, maintain, and understand. Roll up your offerings into half a dozen categories or fewer.</p>
                                </div>
                            </div>
                            @foreach ($sales as $row)
                                <div class="each-entry col-xs-12">
                                    <div class="each-entry-title col-xs-12">{{ $row->sales_forecast_name}}</div>
                                    
                                    <?php 
                                    $months_data_html = "";
                                    $months_display_html = "";
                                    $years_data_html = "";
                                    $years_display_html = "";
                                    $year_totals = explode(",", $row->totals); 
                                    
                                    foreach ($months as $index => $month) {
                                        $key = "month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
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
                                            <a href="{{ url('plan/financial-plan-sales-forecast/edit/' . $row->sf_id) }}" class="edit-sale" data-sf_id="{{ $row->sf_id }}" data-sales_forecast_name="{{ $row->sales_forecast_name }}" data-price="{{ $row->price }}" data-cost="{{ $row->cost }}" data-months='{ {{ $months_data_html }} }' data-years='{ {{ $years_data_html }} }'>
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
                                <a href="#" class="btn btn-primary" id="add-sale">Add a Sale</a>
                            </div>
                        </div>
                        <div class="col-xs-12" id="edit-sale" style="padding: 0px; display: none;">
                            <div class="intro-block ">
                                <div class="widget-content">
                                    <h3>How much of this product will you sell?</h3>
                                    <p>How many "units" of this product or service will you sell? For a product business, a unit could be a shirt or a computer. For a service business, it could be an hour of consulting time, or a single session. You decide what makes sense for your business.</p>
                                    <p>Click and type in each monthly cell to enter the number of units you will sell in the first year. Don't forget to enter annual projections for the following years, down below.</p>
                                    <h3>What will you charge for each unit?</h3>
                                    <p>You'll need to figure out the average selling price for each unit of this product or service. Do you bill at &pound;150 per hour? Sell shirts that average &pound;25 or &pound;65? Don't worry about getting the exact price right, we're doing planning and it's about summarizing and making generalizations. But, if there is really no common-sense average price for this category, you might want to rethink how you grouped your products or services together.</p>
                                    <p>You can use the same price-per-unit for each month, or vary them seasonally if you plan to offer special sales. Use the link in the lower left corner, if necessary, to switch between having one constant price or changing your price from period to period</p>
                                    <h3>How much will it cost you just to provide each unit?</h3>
                                    <p>If you buy shirts for one price and sell them for another, this is easy: whatever you spend on buying a single shirt as inventory is your direct cost. However, if you add value to your products along the way (a restaurant doesn't just resell raw food, it chops and mixes and cooks it), you may want to take that into account . Basically, your direct costs are anything that gets completely used up or goes away when you sell your product or service. This also means that the more you sell, the higher your related costs are.</p>
                                    <p>Even service businesses may have direct costs. For example, a law firm could track its lawyers' billable hour salaries as direct costs; they vary in direct relation to how much the same lawyer bills the clients.</p>
                                </div>
                            </div>
                            <form id="sale-form" action="{{ url('plan/financial-plan-sales-forecast') }}" method="POST">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <input name="sf_id" value="" type="hidden"/>
                                
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Fill in the details for this sales forecast</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%;">
                                            <div class="num"> 1</div>
                                            <h4 class="label">What do you want to call this sale forecast?</h4>
                                            <div class="step-inner form-group"  style="width: 100%;">
                                                <input type="text" name="sales_forecast_name" value="Test 1" maxlength="255" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 2</div>
                                            <h4 class="label">How much of this product will you sell?</h4>
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
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 3</div>
                                            <h4 class="label">What will you charge for each unit?</h4>
                                            <div class="step-inner form-group">
                                                <input type="text" name="price" value="" maxlength="11" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 4</div>
                                            <h4 class="label">How much will it cost you just to provide each unit?</h4>
                                            <div class="step-inner form-group">
                                                <input type="text" name="cost" value="" maxlength="11" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-sale">Save</button>
                                    <a href="{{ url('plan/financial-plan-sales-forecast-delete') }}"  class="btn btn-danger" id="delete-sale">Delete</a>
                                    <a href="#" class="btn btn-default" id="cancel-sale">Cancel</a>
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
        <a class="btn btn-default back-to-outline" href="{{ url('plan/financial-plan/sales-forecast/' . $business_plan->id) }}" >I'm Done</a>
    </div>
</div> <!-- end row -->

@stop