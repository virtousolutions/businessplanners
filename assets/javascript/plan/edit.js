$(document).ready( function () {
    $('#notification').fadeOut(10000);

    $("a.intro-block-toggle").click(function () {
        if ($(this).hasClass('expanded')) {
            $(this).removeClass('expanded');
            $(this).find('span').html('Show Instructions');
            $(this).next().hide();
        }
        else {
            $(this).addClass('expanded');
            $(this).find('span').html('Hide Instructions');
            $(this).next().show();
        }
    });

    tinyMCE.init({
        // General options
         // General options
       // mode : "textareas", -- THIS WILL APPLY THE FUNCTION TO EVERY TEXT AREA WITHIN THIS FILE --
       	mode : "exact",
		elements : "page_content",
        theme : "advanced",
        plugins : "table,inlinepopups",

        // Theme options
		
		//underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,
		
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,|,table,removeformat,code, |, sub,sup,",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        content_css : "http://localhost/thebusinessplanners/assets/plugins/tinymce/examples/css/content.css",

        // Style formats
        
		style_formats : [
                {title : 'Bold text', inline : 'b'},
                {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                {title : 'Example 1', inline : 'span', classes : 'example1'},
                {title : 'Example 2', inline : 'span', classes : 'example2'},
                {title : 'Table styles'},
                {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
        ],

        formats : {
                alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
                aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
                alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
                alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
                bold : {inline : 'span', 'classes' : 'bold'},
                italic : {inline : 'span', 'classes' : 'italic'},
                underline : {inline : 'span', 'classes' : 'underline', exact : true},
                strikethrough : {inline : 'del'},
                customformat : {inline : 'span', styles : {color : '#00ff00', fontSize : '20px'}, attributes : {title : 'My custom format'}}
        }
    });

    $("a.link-main-page").click(function() {
        $("div.chapter-edit-section").hide();
        $("div.chapter-main").show();
        return false;
    });

    $("a.link-edit-section-content").click(function() {
        var data = $(this).data();
        var data_container = $("div.chapter-section-data-" + data['url']);
        
        editSection(data_container);
        
        return false;
    });

    $("#form-edit-section-content button").click(function () {
        var form = $("#form-edit-section-content");
        var data = form.serializeArray();
        var values = {};
        var self = this;
        

        $.each(data, function (i, input) {
            values[input.name] = input.value;
        });

        values['page_content'] = tinyMCE.activeEditor.getContent();
        var form_data = form.data();
        var action_url = values['section_id'] * 1 == 0 ? form_data['action_page'] : form_data['action_section'];

        form.find('.btn').addClass('disabled');
        $("#save-section-message").show();

        $.ajax({
            method: "post",
            url: action_url, 
            dataType: 'json',
            data: values,
            success: function(result){
                var data_container = $("div.chapter-section-data-" + values['sub_section']);

                if (data_container.find('div.chapter-sub-section-data').length > 0)  {
                    data_container = $('div.chapter-sub-section-data-' + values['section_id']);
                }

                data_container.find("span[name='value']").html(values['page_content']);
                
                form.find('.btn').removeClass('disabled');
                $("#save-section-message").hide();
                $("#save-section-message-success").html(result.text);
                $("#save-section-message-success").show();

                $("#save-section-message-success").fadeOut(10000);

                if ($(self).attr('name') == 'save_continue') {
                    var key = values['sub_section'];
                    var data_container = $("div.chapter-section-data-" + key);
                    var next = data_container.next();

                    if (next.length > 0) {
                        var new_key = next.find("span[name='url']").html();
                        var data_container = $("div.chapter-section-data-" + new_key);
                        editSection(data_container);
                    }
                }
            }
        });
        
        return false;
    });

    $("a.back-edit-section").click(function() {
        var key = $("#form-edit-section-content").find("input[name='sub_section']").val();
        var data_container = $("div.chapter-section-data-" + key);
        var prev = data_container.prev();

        if (prev.length > 0) {
            var new_key = prev.find("span[name='url']").html();
            var data_container = $("div.chapter-section-data-" + new_key);
            editSection(data_container);
        }
        else {
            $("div.chapter-edit-section").hide();
            $("div.chapter-main").show();
        }

        return false;
    });

    if (SELECTED_SUB_PAGE != '') {
        var data_container = $("div.chapter-section-data-" + SELECTED_SUB_PAGE);
        editSection(data_container);
    }
});


function editSubpageSection(elem) {
    var data = $(elem).data();
    var data_container = $("div.chapter-section-data-" + data['pageurl']);
    
    // set the section to edit
    data_container.data('section_id', data['sectionid']);

    editSection(data_container);

    return false;
};

function editSection(data_container) {
    $('#sub-page-sub-sections-1').html("");
    $('#sub-page-sub-sections-2').html("");

    if (data_container.find('div.chapter-sub-section-data').length > 0)  {
        var data2 = data_container.data();
        var section_id = !data2['section_id'] ? 0 : data2['section_id'];
        
        // add the sections
        addSubpageSections(data_container);

        data_container = data_container.find('div.chapter-sub-section-data-' + section_id);

        $('#sub-page-sub-sections-1').show();
        $('#sub-page-sub-sections-2').show();

        var section_id = data_container.find("span[name='section_id']").html();
    }
    else {
        $('#sub-page-sub-sections-1').hide();
        $('#sub-page-sub-sections-2').hide();

        var section_id = 0;
    }

    var title = data_container.find("span[name='title']").html();
    var url = data_container.find("span[name='url']").html();
    var id = data_container.find("span[name='id']").html();
    var value = data_container.find("span[name='value']").html();
    var instructions = data_container.find("span[name='instructions']").html();
    var builder = data_container.find("div[name='the-builder']");

    if (section_id * 1 == 0) {
        $("div.chapter-edit-section").find("legend").html(title);
    }
    
    if (instructions == "") {
        $(".chapter-edit-section a.intro-block-toggle").hide();
        $(".chapter-edit-section div.intro-block").hide();
    }
    else {
        $(".chapter-edit-section a.intro-block-toggle").show();
        $(".chapter-edit-section div.intro-block").show();
    }

    if (builder.length > 0) {
        $("#sub-page-builder-container").html(builder.html());

        var template = $("#edit-sub-page-section-current-template");
        var clone = template.clone();
        
        clone.attr('id', '');
        clone.find('h4').html("About " + title);
        clone.css('margin-top', '20px');
        clone.show();

        $("#sub-page-builder-container").append(clone);

        $("#sub-page-builder-container").show();
    }
    else {
        $("#sub-page-builder-container").html('');
        $("#sub-page-builder-container").hide();
    }

    $("div.chapter-edit-section").find("div.widget-content p").html(instructions);

    if (tinyMCE.activeEditor) {
        tinyMCE.activeEditor.setContent(value);
    }
    else {
        $("#page_content").val(value);        
    }

    $("#form-edit-section-content").find("input[name='sub_section']").val(url);
    $("#form-edit-section-content").find("input[name='page_id']").val(id);
    $("#form-edit-section-content").find("input[name='section_id']").val(section_id);

    $("div.chapter-main").hide();
    $("div.chapter-edit-section").show();

    var next = data_container.next();

    if (next.length > 0) {
        $("#form-edit-section-content").find("button[name='save_continue']").show();
    }
    else {
        $("#form-edit-section-content").find("button[name='save_continue']").hide();
    }

    $("a.link-edit-section-content").removeClass('selected');
    $("a.link-edit-section-content-" + url).addClass('selected');

    // focus on the textbox
    var element = $("div.rich_textarea");
    var offset = element.offset().top - $(window).scrollTop();

    if(offset > window.innerHeight){
        // Not in view so scroll to it
        $('html,body').animate({scrollTop: offset}, 1000);
    }
}

function addSubpageSections(div)
{
    var data = div.data();
    var section_id = !data['section_id'] ? 0 : data['section_id'];
    var container = $('#sub-page-sub-sections-1');
    
    $.each(div.children(), function(i, sub_div) {
        sub_div = $(sub_div);
        var title = sub_div.find("span[name='title']").html();
        var url = sub_div.find("span[name='url']").html();
        var id = sub_div.find("span[name='id']").html();
        var s_id = sub_div.find("span[name='section_id']").html();
        var value = sub_div.find("span[name='value']").html();
        
        if (s_id == section_id) {
            var template = $("#edit-sub-page-section-current-template");
        }
        else {
            if (value == '') {
                var template = $("#edit-sub-page-section-empty-template");
            }
            else {
                var template = $("#edit-sub-page-section-with-value-template");
            }
        }

        var clone = template.clone();
        clone.attr('id', '');
        clone.find('h4').html(title);

        if (s_id == section_id) {
            
        }
        else {
            clone.attr('data-pageurl', url);
            clone.attr('data-pageid', id);
            clone.attr('data-sectionid', s_id);
        
            if (value == '') {
                var a_elem = clone;
                clone.find('div.sub-page-sub-section-container').css('margin-bottom', '40px');
            }
            else {
                var a_elem = clone.find("a.edit-sub-page-section");
                clone.css('margin-bottom', '40px');
                clone.find('div.sub-page-sub-section-value-container').html(value);
            }

            a_elem.attr('data-pageurl', url);
            a_elem.attr('data-pageid', id);
            a_elem.attr('data-sectionid', s_id);
            a_elem.attr('onclick', 'javascript:return editSubpageSection(this);');
        }

        container.append(clone);
        clone.show();

        if (s_id == section_id)
        {
            container = $('#sub-page-sub-sections-2');
        }
    })
}