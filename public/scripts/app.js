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
        if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
            notify(jqXHR.responseJSON.error, 'error');
        }
        else {
            notify('Sorry, some error occured', 'error');
        }
    }
}