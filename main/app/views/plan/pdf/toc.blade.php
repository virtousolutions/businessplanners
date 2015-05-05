<table class="table" cellspacing="0" cellpadding="1">
    @foreach ($contents as $content)
        <tr style="font-size: 18px; color: #6f0b0d;">
            <td class="genval">{{ $content['title'] }}</td>
            <td class="text-right">{{ $content['page_num']; }}</td>
        </tr>
        @foreach ($content['sub_pages']as $sub_page)
            <tr style="font-size: 14px; color: black;">
                <td class="genval">{{ $sub_page['title'] }}</td>
                <td class="text-right">{{ $sub_page['page_num']; }}</td>
            </tr>
        @endforeach

        <tr style="font-size: 10px; color: black;">
            <td class="genval">&nbsp;</td>
            <td class="text-right">&nbsp;</td>
        </tr>
    @endforeach
</table>
