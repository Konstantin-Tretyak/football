    ///XMLHttpReqquest
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'teams.json', true);
    xhr.send(null);
    var team;

    xhr.onreadystatechange = function() 
    {
        if (xhr.readyState != 4) return;

        team = JSON.parse(xhr.responseText);
    }
    ///End XMLHttpReqquest

    ///Other variabels
    var games_table = document.getElementsByClassName("table table-striped games")[0];
    var modal_users_like = document.getElementsByClassName("modal_users_like")[0];
    var modal_users_like_sumbit = modal_users_like.getElementsByTagName('button')[0];
    var modal_message_for_user = modal_users_like.getElementsByClassName("message_for_user")[0];
    ///End other variabels

    games_table.onclick = function(event)
    {
        var target = event.target;

        while (target != games_table)
        {
            if (target.className == "btn btn-primary users_like")
            {

                modal_users_like.style.display = "block";
                var team_name = modal_message_for_user.getElementsByClassName('team_name')[0];

                var i=0;
                while(team[i].id != target.id)
                {
                    i++;
                    continue;
                }
                team_name.innerHTML = team[i].name;

                modal_users_like_sumbit.setAttribute('value', target.id);
            }

            target = target.parentNode;
        }
    }
