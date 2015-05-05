var SELECTED_TAB = '';

$(document).ready(function () {
    $("a.financial-plan-tab-edit").click(function() {
        if ($(this).hasClass('active')) {
            return false;
        }

        var data = $(this).data();
        var container = $(this).closest('div.financial-plan-editor');
        

        container.find("a.financial-plan-tab-edit").removeClass('active');
        $(this).addClass('active');

        container.find("div.financial-plan-tab-edit").hide();
        $("div." + data.name + "-financial-plan-tab-edit").show();

        $("input[name='" + data.elem_name + "']").val(data.name);

        SELECTED_TAB = data.name;

        return false;
    })

    // get the selected tab value
    $("a.financial-plan-tab-edit").each(function (i, e) {
        if ($(e).hasClass('active')) {
            SELECTED_TAB = $(e).data('name');
        }
    });
});