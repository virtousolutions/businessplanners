    <div class="selected-expense">
        <div class="item-header">
            <h3>{{ $title }}</h3>
        </div>
        <div class="expense-budget-entryMethod">
            <div class="step expense-name">
                <div class="num"> 1</div>
                <h4 class="label">{{ $labels[0] }}</h4>
                    
                <div class="step-inner">
                    <p>{{ $instructions[0] }}</p>
                     <div class="slider-control" id="{{ $type }}_slider_percentage">
                        <input type="text" id="{{ $type }}_percentage" name="{{ $type }}_percentage" value="{{ $values[0] }}" data-original_value="{{ $values[0] }}"/>
                        <span class="percent">%</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="expense-budget-entryMethod">
            <div class="step expense-name">
                <div class="num"> 2</div>
                <h4 class="label">{{ $labels[1] }}</h4>
                <div class="step-inner">
                    <p>{{ $instructions[1] }}</p>
                    <div class="slider-control" id="{{ $type }}_slider_collection">
                        <input type="text" id="{{ $type }}_collection" name="{{ $type }}_collection" value="{{ $values[1] }}" data-original_value="{{ $values[1] }}"/>	
                        <span class="percent">days</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
