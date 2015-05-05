<table class="table" cellspacing="1" cellpadding="1">
    <tr style="font-size: 12px; color: #000000;">
        <td></td>
        @foreach ($months as $month)
            <td style="text-align: center;"><b>{{ $month }}</b></td>
        @endforeach
    </tr>
    <?php
    $html_unit_sales = "";
    $html_price = "";
    $html_sales = "";
    $html_unit_cost = "";
    $html_cost = "";
    
    foreach ($sales as $sale) {
        $a_unit_sale = $a_price = $a_sale = $a_cost = '<tr style="font-size: 12px; color: #000000;"><td>' . $sale->sales_forecast_name . '</td>';

        for ($index = 0; $index < 12; $index++) {
            $key = "month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
            $value = $sale->$key;

            $a_unit_sale .= '<td style="text-align: right;">' . $value . '</td>';
            $a_price .= '<td style="text-align: right;">' . number_format($sale->price, 2) . '</td>';
            $a_sale .= '<td style="text-align: right;">' . number_format($monthly_sales[$index], 2) . '</td>';
            $a_cost .= '<td style="text-align: right;">' . number_format($sale->cost, 2) . '</td>';
        }
        
        $a_unit_sale .= '</tr>';
        $a_price .= '</tr>';
        $a_sale .= '</tr>';
        $a_cost .= '</tr>';

        $html_unit_sales .= $a_unit_sale;
        $html_price .= $a_price;
        $html_sales .= $a_sale;
        $html_unit_cost .= $a_cost;
    }
    ?>

    <tr style="font-size: 12px; color: #000000;">
        <td><b>Unit Sales</b></td>
        <td colspan="12"></td>
    </tr>
    {{ $html_unit_sales }}

    <tr style="font-size: 12px; color: #000000;">
        <td><b>Price Per Unit</b></td>
        <td colspan="12"></td>
    </tr>
    {{ $html_price }}

    <tr style="font-size: 12px; color: #000000;">
        <td><span style="font-weight: bold;">Sales</span></td>
        <td colspan="12"></td>
    </tr>
    {{ $html_sales }}

    <tr style="font-size: 12px; color: #000000;">
        <td><b>Direct Cost Per Unit</b></td>
        <td colspan="12"></td>
    </tr>
    {{ $html_unit_cost }}

</table>
