$(document).ready
(
    function()
    {
        $("form.comment").on ('submit',
          function(event)
          {
             event.preventDefault();
             var form = $(this);
             $.ajax
                (
                    $("form").attr('action'),
                    {
                        type: 'POST',
                        dataType: 'json',
                        data: $("form").serialize(),
                        success: function(result)
                        {
                            $("form").trigger("reset");
                            ///TODO: Delete errors when it's all right

                            var msg = $("<li></li>");
                            msg.append("<h3>"+result.author_name+"</h3>");
                            msg.append("<h4>"+result.body+"</h4>");
                            msg.append("<p>"+result.date+"</p>");

                            $(".comments").prepend(msg);

                            notify('You are created comment', 'success');
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
    }
);