$(document).ready
(
    function()
    {
        $("form.subscribe").on ('submit',
          function(event)
          {
             //alert($(this).find("button").attr("id")-1);
             //form = $("form")[0];
             event.preventDefault();
             var form = $(this);
             var status;
             if(form.find("button").hasClass("btn-danger"))
                status = "delete";
             else
                status = "subscribe";
             $.ajax
                (
                    $(this).attr('action'),
                    {
                        type: 'POST',
                        dataType: 'json',
                        data: "team_id="+($(this).find("button").attr("id"))+"&status="+status,
                        success: function(result)
                        {
                            ///show messages
                                if(result.status=="deleted")
                                    notify("Yoa Are Describe At Team", 'error');
                                else
                                    notify("Yoa Are Add Team To You're Storage", 'success');
                            ///

                            ///change button view
                                var id = form.find("button").attr("id");
                                if(form.find("button").hasClass("btn-primary"))
                                {
                                    $("form").find('[id='+id+']').removeClass("btn-primary").addClass("btn-danger");
                                    //form.find("button").addClass("btn-danger");   
                                }
                                else if(form.find("button").hasClass("btn-danger"))
                                {
                                    $("form").find('[id='+id+']').removeClass("btn-danger").addClass("btn-primary"); 
                                }
                            ///
                        },
                        error: function ( jqXHR )
                        {
                            app.defaultAjaxError("form", jqXHR);
                        },
                        beforeSend: function()
                        {
                            form.addClass("whirl");
                        },
                        complete: function()
                        {
                            form.removeClass("whirl");
                        }
                    }
                )
          }
        );

        /*$(document).ajaxSend(function(event, request, settings) {
        $("form").addClass("whirl");
        });*/

        /*$(document).ajaxComplete(function(event, request, settings) {
        $("form").removeClass("whirl");
        });*/
    }
);

PNotify.prototype.options.styling = "bootstrap3";

function notify(text, status, autohide, icon) 
{
    if (status === undefined) status = 'success';
    if (autohide === undefined) autohide = true;
    if (icon === undefined) icon = false;

    new PNotify
    ({
        title: false,
        delay: 5000,
        type: status,
        text: text,
        hide: autohide,
        icon: icon,
        buttons: {sticker: false}
    });
}

app = {
    removeFormErrors: function (form)
    {
        $(form).find('.form-group').find('.help-block').remove();
        $(form).find('.form-group').removeClass('has-error');
    },
    // default AJAX error handler
    defaultAjaxError: function (form, jqXHR)
    {
        // try to obtain response as JSON
        var errors = jqXHR.responseJSON;
        // obtain response text. if it's a JSON, prettify it
        var responseText = (errors) ? JSON.stringify(errors,null,2) : jqXHR.responseText; // it's OK even if response is a regular string
        console.log(responseText);
        // if error is form validation error, collect all errors to array and display them as notification
        if (errors && jqXHR.status == 422)
        {
            // function is taken from http://www.inventpartners.com/javascript_is_int
            function is_int(value) { return ((parseFloat(value) == parseInt(value)) && !isNaN(value)) }
            $.each(errors, function(field, error)
            {
                // if error not is attached to form field, just display it
                if (is_int(field))
                {
                    notify(error, 'error');
                }
                // if error is attached to form field, try to display error under form field
                else
                {
                    var field = $(form).find(':input[name="' + field + '"]');
                    ///Что значит :input[name="
                    // if corresponding field exists, display error under this field
                    if (field.length)
                    {
                        field.after('<p class="help-block">'+error+'</p>');
                        field.closest('.form-group').addClass('has-error');
                    }
                }
            });
        }
        // for other errors just throw common error notification
        else
        {
            notify('Sorry, some error occured', 'error');
        }
    }
}
