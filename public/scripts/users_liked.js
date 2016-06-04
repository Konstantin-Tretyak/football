$(document).ready
(
    function()
    {
        $("form.subscribe").on ('submit',
          function(event)
          {
             event.preventDefault();
             var form = $(this);
             var status = form.data("action");
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
                                if(status=="delete")
                                    notify("You have successfully unsubscribed from team's updates", 'success');
                                else
                                    notify("You have successfully subscribed to team's updates", 'success');
                            ///

                            ///change button view
                                if(status == 'subscribe')
                                {
                                    form.data("action" , 'delete');
                                    form.find(".icon").removeClass("glyphicon-star-empty").addClass("glyphicon-star");
                                }
                                else
                                {
                                    form.data("action" , 'subscribe');
                                    form.find(".icon").removeClass("glyphicon-star").addClass("glyphicon-star-empty"); 
                                }
                            ///
                        },
                        error: function ( jqXHR )
                        {
                            app.defaultAjaxError("form", jqXHR);
                        }
                    }
                )
          }
        );
    }
);


