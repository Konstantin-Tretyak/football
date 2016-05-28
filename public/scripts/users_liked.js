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


