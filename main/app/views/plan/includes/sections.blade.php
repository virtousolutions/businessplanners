<?php $i = 0; ?>
@foreach ($sub_pages as $subpage)
    <div class="section-widget">
        <a href="{{ url('plan/' . trim($plan_main_page) . '/' . trim($subpage->pageurl) . '/' . $business_plan->id) }}" class="block link-edit-section-content" data-url="{{ $subpage->pageurl }}">
            <div class="section-wrapper">
                <div class="block_title">
                    @if (!empty($sub_page_images[$i]))
                    <img src="{{ asset('assets/css/plan/shortcodes_files/images/' . $sub_page_images[$i]) }}">
                    @endif
                    <div class="section-title" style="{{ empty($sub_page_images[$i]) ? 'padding-left: 30px;' : '' }}">
                       <h3>
                            <span class="title">{{ $subpage->pagetitle}}</span>
                        </h3>
                    </div>
                </div><!-- end .block_title -->
                <div class="items">
                    <p class="in-this-section">In this section:</p>
                    <div class="item-list">
                        <span class="item">
                           <span class="item_icon">
                                <img src="{{ asset('assets/css/plan/shortcodes_files/images/iiic.png') }}" width="16" height="22" border="0">
                           </span>
                           <?php
                                $the_details = (!isset($sub_page_sections_data['details']) || !$sub_page_sections_data['details'][$i]) ?
                                                [$subpage->pagetitle] : 
                                                $sub_page_sections_data['details'][$i];
                            ?>
                            @foreach ($the_details as $detail)
                           <span> 
                                <br>  &nbsp; &nbsp;  &nbsp; &nbsp;
                                <img src="{{ asset('assets/css/plan/shortcodes_files/images/eee.PNG') }}"> {{ $detail }}&nbsp;
                           </span>  
                           @endforeach
                       </span>
                    </div>
               </div><!----end of .items -->
           </div><!--end of .section-wrapper-->
       </a>
    </div>

    <?php $i++; ?>
@endforeach
