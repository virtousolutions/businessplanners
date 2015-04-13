$(document).ready(function () {
    var slider1 = new dhtmlxSlider('incoming_slider_percentage', {
        skin: "ball", //dhx_skyblue
        min: 0,
        max: 100,
        step: 5,
        size: 420,
        value: $("input[name='incoming_percentage']").val(),
        vertical: false
    });
    
    slider1.linkTo('incoming_percentage');
    slider1.init();
  
    var slider2 = new dhtmlxSlider('incoming_slider_collection', {
        skin: "ball", //dhx_skyblue
        parent: 'incoming_percentage_div',
        min: 0,
        max: 180,
        step: 30,
        size: 420,
        value: $("input[name='incoming_collection']").val(),
        vertical: false
     });
  
    slider2.linkTo('incoming_collection');
    slider2.init();

    var slider3 = new dhtmlxSlider('outgoing_slider_percentage', {
        skin: "ball", //dhx_skyblue
        min: 0,
        max: 100,
        step: 5,
        size: 420,
        value: $("input[name='outgoing_percentage']").val(),
        vertical: false
    });
    
    slider3.linkTo('outgoing_percentage');
    slider3.init();
  
    var slider4 = new dhtmlxSlider('outgoing_slider_collection', {
        skin: "ball", //dhx_skyblue
        parent: 'outgoing_percentage_div',
        min: 0,
        max: 180,
        step: 30,
        size: 420,
        value: $("input[name='outgoing_collection']").val(),
        vertical: false
     });
  
    slider4.linkTo('outgoing_collection');
    slider4.init();

    cash_flow_projection.init();
});

var cash_flow_projection = {
    changed : false,
    data : null,
    init : function () {
        var self = this;

        $("#save-cash-flow-projection").click(function() {
            $("#save-cfp-message-error").hide();
            $("#save-cfp-message-success").hide();
            $("#save-cfp-message").hide();

            // check if changes were made
            var form = $("form[name='cash-flow-projection']");
            var serialized = form.serializeArray();
            var data = {};

            $.each(serialized, function (i, input) {
                data[input.name] = input.value;
            });

            var original_percentage = form.find("input[name='" + data['cash-flow-payment-type'] + "_percentage']").data();
            var original_percentage = original_percentage['original_value'];
            var original_collection = form.find("input[name='" + data['cash-flow-payment-type'] + "_collection']").data();
            var original_collection = original_collection['original_value'];

            var action_url = form.attr('action');
            
            if (
                original_percentage * 1 != data[data['cash-flow-payment-type'] + '_percentage'] * 1 || 
                original_collection * 1 != data[data['cash-flow-payment-type'] + '_collection'] * 1
            )
            {
                self.changed = true;
                self.data = data;

                //  go save
                $("#save-cfp-message").show();

                $.ajax({
                    method: "post",
                    url: action_url, 
                    dataType: 'json',
                    data: data,
                    success: function(result){
                        $("#save-cfp-message").hide();

                        $("#save-cfp-message-success").html(result.text);
                        $("#save-cfp-message-success").show();
                        
                        var percentage = data['cash-flow-payment-type'] + "_percentage";
                        var collection = data['cash-flow-payment-type'] + "_collection";;

                        form.find("input[name='" + percentage + "']").data('original_value', data[percentage]);
                        form.find("input[name='" + collection + "']").data('original_value', data[collection]);
                    }
                });
            }
            else {
                $("#save-cfp-message-error").html("There are no changes to save");
                $("#save-cfp-message-error").show();
            }

            return false;
        })

        $('a.back-to-outline').click(function () {
            // refresh the page
            var new_location = $(this).attr('href') + "&cash_flow_payment_type=" + SELECTED_TAB;
            window.location = new_location;
            return false;
        })
    }
}