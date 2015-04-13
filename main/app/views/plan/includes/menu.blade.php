
<div class="col-md-3 col-sm-4 col-xs-12 sidebar-menu">
    <ul>
        @foreach ($plan_main_pages as $main_page)
            @if ($main_page->pageurl == 'appendix')
                <?php break; ?>
            @endif
            <li class="{{ $plan_main_page == $main_page->pageurl ? 'selected-main-page' : 'not-selected' }}">
				<div class="title not-selected">
                    <!--<a class='function chapter-title'>
                        <span></span>
                    </a>-->
                    
                    <a href="{{ url('plan/' . trim($main_page->pageurl) . '/' . $business_plan->id) }}" class="main-menu-link {{ $plan_main_page == $main_page->pageurl ? 'link-main-page' : '' }}">{{ $main_page->pagetitle }}</a>
                </div>

                @if ($plan_main_page == $main_page->pageurl)
                    <ul class="submenu">
                        @foreach ($plan_sub_pages[$main_page->pageid] as $sub_page)
                            <li class="">
                                <a href="{{ url('plan/' . trim($main_page->pageurl) . '/' . trim($sub_page->pageurl) . '/' . $business_plan->id) }}" class="link-edit-section-content link-edit-section-content-{{ $sub_page->pageurl }}" data-url="{{ $sub_page->pageurl }}"><span></span>{{ $sub_page->pagetitle }}</a>
                             </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach

        <li class="{{ $plan_main_page == 'details' ? 'selected-main-page' : 'not-selected' }}">
            <div class="title not-selected">
                <a href="{{ url('plan/details/' . $business_plan->id) }}" class="main-menu-link {{ $plan_main_page == 'details' ? 'link-main-page' : '' }}">Plan Details</a>
            </div>
        </li>
    </ul>
</div>
