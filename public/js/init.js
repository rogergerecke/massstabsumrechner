(function ($) {
    'use strict';

  /*  // function to send the ajax request in background with the formula data
    $("#scaleUnit").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = './ajax.php';

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                $('.test_response').html(data) // todo update the response
            }
        })

    });

    // trigger button change and submit the form this start ajax submit above
    $("button[type='submit'][name='scale']").change(function () {

        setTimeout(function () {
            $('#scaleUnit').submit()
        }, 2000)

    });*/

    function addtoev() {
        var i=0;
        const buttons = document.getElementsByName("scale");
        for (let button of buttons) {
            button.addEventListener("click", function() {
                let value = button.getValue(0);
                console.log("you clicked" + value); });
        }
    }

    window.addEventListener("load",function() {
        addtoev();
    });
})(jQuery);
