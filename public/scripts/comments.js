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

                            msg.append(`
                                <p>
                                    <span class="glyphicon glyphicon-comment margin-right-10"></span>
                                    `+result.author_name+` в <i>`+result.date+`</i>
                                </p>
                                <blockquote>
                                    `+result.body.replace(/([^>])\n/g, '$1<br/>')+`
                                </blockquote>
                                <hr>                                
                            `);
                            $(".comments").prepend(msg);

                            notify('You have successfully created a comment', 'success');
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