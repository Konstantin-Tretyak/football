$(document).ready
(
    function()
    {
        $("form").on ('submit',
          function(event)
          {
             event.preventDefault();
             $.ajax
                (
                    $("form").attr('action'),
                    {
                        type: 'POST',
                        // contentType: 'application/json',
                        dataType: 'json',
                        data: $("form").serialize(),
                        success: function(result)
                        {
                            // https://jsfiddle.net/gabrieleromanato/bynaK/

                            //$("div").hide().html(result).fadeIn();

                            // TODO: display created comment + success notification
                            alert(result);
                        },
                        error: function ( jqXHR ) {
                            // https://github.com/absent1706/laravel-minihabr/blob/master/public/js/app.js

                            // TODO: handle validation errors by adding errors under fields
                            // TODO: make notifications: use https://sciactive.github.io/pnotify. Display success as green message, error - as red one.
                            // TODO: by default, show/hide loading indicator for all AJAX requests ($(document).ajaxSend and $(document).ajaxComplete) - use http://jh3y.github.io/whirl/. 
                            //    Example: http://laravel-minihabr.16mb.com
                            //       also, standard way to handle errors (pass form DOM element to this function). 
                            //         Example: defaultAjaxError in https://github.com/absent1706/laravel-minihabr/blob/master/public/js/app.js, call of this function at https://github.com/absent1706/laravel-minihabr/blob/master/resources/views/articles/show.blade.php
                            // 

                            if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                                alert(jqXHR.responseJSON.error);
                            }
                            else {
                                alert('Sorry, some error occured. Try again later');
                            }
                        }
                    }
                )
          }
        );
    }
);