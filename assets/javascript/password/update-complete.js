var count = 5;

$(document).ready(function () {
    countdown()
});

function countdown()
{
    if (count == 0)
    {
        window.location = $("#login_url").attr('href');
    }

    $("#seconds").html(count + "");
    count--;

    setTimeout(countdown, 1000);
}