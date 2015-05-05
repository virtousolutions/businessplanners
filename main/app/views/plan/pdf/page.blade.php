<table style="width: 100%;">
    @if (!empty($content['title']))
        <tr style="width: 100%; font-size: 25px; color: #6f0b0d;">
            <td>{{ $content['title'] }}</td>
        </tr>
    @endif
    @foreach ($content['sub_pages']as $sub_page)
        <tr style="width: 100%; font-size: 15px; color: black;">
            <td>&nbsp;</td>
        </tr>
        <tr style="width: 100%; font-size: 18px; color: black;">
            <td>{{ $sub_page['title'] }}</td>
        </tr>
        <tr style="width: 100%; font-size: 10px; color: black;">
            <td>&nbsp;</td>
        </tr>
        <tr style="width: 100%; font-size: 14px; color: black;">
            <td>{{ $sub_page['content']; }}</td>
        </tr>
    @endforeach
</table>
