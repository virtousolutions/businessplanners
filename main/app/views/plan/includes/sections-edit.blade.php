<div class="col-xs-12 chapter-edit-section"  style="margin-bottom: 30px; padding: 0px; display: none;">
    <legend></legend>
    <a id="edit-sub-page-section-empty-template" href="#" class="edit-sub-page-section" style="display: none;">
        <div class="sub-page-sub-section-container">
            <h4></h4>
            <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;">Get started on writing this item</div>
        </div>
    </a>
    <div id="edit-sub-page-section-with-value-template" class="sub-page-sub-section-container" style="display: none;">
        <h4></h4>
        <div class="click-to-edit" style="margin-right: -22px;  margin-top: -30px;">
            <div class="tuck">
                <a href="#" class="edit-sub-page-section">
                    <div class="flag">
                        <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                    </div>
                </a>
            </div>
       </div>
        <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;"></div>
    </div>
    <div id="edit-sub-page-section-current-template" class="sub-page-sub-section-container" style="display: none;">
        <h4></h4>
        <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;">Fill up the text area below</div>
    </div>
    <div id="sub-page-sub-sections-1" style="display: none; float: left; width: 100%;">
    </div>
    <a class="intro-block-toggle expanded" href="javascript:void(0);" id="ext-gen13"><span>Hide Instructions</span></a>
    <div id="introText" class="intro-block dim-action-intro-block" style="display: block;">
        <span class="tip"></span>
        <div class="widget-content">
            <p></p>
            <span class="clear"></span>
        </div>
    </div>
    <div id="sub-page-builder-container" style="display: none; float: left; width: 100%;">
        
    </div>
    
    <form method="post" id="form-edit-section-content" data-action_page="{{ url('plan/save_page') }}" data-action_section="{{ url('plan/save_section') }}">
        <input type="hidden" name="business_plan_id" value="{{ $business_plan->id }}"/>
        <input type="hidden" name="main_section" value="{{ $plan_main_page }}"/>
        <input type="hidden" name="sub_section" value=""/>
        <input type="hidden" name="section_id" value=""/>
        <input type="hidden" name="page_id" value=""/>
        <div class="rich_textarea" style="margin-top: 15px; margin-bottom: 15px; float: left; width: 100%;">
            <textarea id="page_content" name="page_content" type="text" style="width:535px; height:250px;" ></textarea>
        </div>
        <div class="col-xs-12" style="padding: 0px;">
            <a class="btn btn-default pull-left back-edit-section">Back</a>
            <button class="btn btn-primary pull-right" name="save_continue" type="submit">Save and Continue</button>
            <button class="btn btn-primary pull-right" name="save" type="submit" style="margin-right: 5px;">Save</button>
        </div>
        <div class="col-xs-12" style="padding: 0px; min-height: 50px;">
            <div class="col-xs-12" style="padding: 0px; margin-top: 15px; display: none;" id="save-section-message">
                <img style="width: 30px; margin-right: 10px;" src="{{ asset('assets/img/loading.gif') }}"/>
                <span style="font-size: 15px;">Saving your changes. Please don't leave the page</span>
            </div>
            <div class="col-xs-12 alert alert-success" style="padding: 15px; margin-top: 15px; font-size: 15px; display: none;" id="save-section-message-success">
            </div>
        </div>
    </form>
    <div id="sub-page-sub-sections-2" style="display: none; float: left; width: 100%;">
    </div>
</div>
<div class="col-xs-12 chapter-section-values"  style="padding: 0px; display: none;">
    <?php $i = 0; ?>
    @foreach ($plan_sub_pages[$plan_main_page_id] as $subpage)
        <?php 
            $pageurl = trim($subpage->pageurl);
            $pageurl_key = str_replace('-', '_', $pageurl);
        ?>
        @if (isset($plan_sub_page_sections[$subpage->pageid]))
            <div class="chapter-section-data-{{ $subpage->pageurl }}">

                <div class="chapter-sub-section-data chapter-sub-section-data-0">
                    <span name="title">{{ $subpage->pagetitle }}</span>
                    <span name="url">{{ $pageurl }}</span>
                    <span name="id">{{ $subpage->pageid }}</span>
                    <span name="section_id">0</span>
                    <span name="value">{{ isset($values[$pageurl_key]) ? $values[$pageurl_key] : '' }}</span>
                    <span name="instructions">{{ isset($instructions[$i]) ? $instructions[$i] : '' }}</span>
                </div>

            @foreach ($plan_sub_page_sections[$subpage->pageid] as $subpagesection)
                <div class="chapter-sub-section-data chapter-sub-section-data-{{ $subpagesection->section_id }}">
                    <span name="title">{{ $subpagesection->section_title }}</span>
                    <span name="url">{{ $pageurl }}</span>
                    <span name="id">{{ $subpage->pageid }}</span>
                    <span name="section_id">{{ $subpagesection->section_id }}</span>
                    <span name="value">{{ isset($section_values[$subpagesection->section_id]) ? $section_values[$subpagesection->section_id] : '' }}</span>
                    <span name="instructions">{{ $subpagesection->section_desc }}</span>
                </div>
            @endforeach

            </div>
        @else
            <div class="chapter-section-data-{{ $subpage->pageurl }}">
                <span name="title">{{ $subpage->pagetitle }}</span>
                <span name="url">{{ $pageurl }}</span>
                <span name="id">{{ $subpage->pageid }}</span>
                <span name="value">{{ isset($values[$pageurl_key]) ? $values[$pageurl_key] : '' }}</span>
                <span name="instructions">{{ isset($instructions[$i]) ? $instructions[$i] : '' }}</span>

                @if (
                    !empty($sub_page_sections_data['includes']) && 
                    isset($sub_page_sections_data['includes'][$i]) && 
                    $sub_page_sections_data['includes'][$i] !== null)
                )
                <div name="the-builder">
                    @include($sub_page_sections_data['includes'][$i], ['data' => $sub_page_sections_data['data'][$i], 'options' => $sub_page_sections_data['options']])
                </div>
                @endif
            </div>
        @endif
        <?php $i++; ?>
    @endforeach
</div>
