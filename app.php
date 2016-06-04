<?php


require __DIR__.'/settings.php';
require __DIR__.'/Autoloading.php';

$connection_string = "mysql:host=localhost;dbname=foot";
$user = 'root';
$password = '';
$conn = new PDO($connection_string, $user, $password);

DbModel::setConnection($conn);

// TODO:  Fatal error: Call to undefined method Player::home_team() in D:\xampp\htdocs\football_with_controllers\app.php on line 17 это при доблении нового игрока - то есть не там срабатывает. Как определить, какой метод класс мне нужен. Как проверить существование метода или свойства у объекта?
Game::afterCreateObserver(function($game)
{
        $message = "Игра ".$game->home_team()->first()->name." - ".$game->guest_team()->first()->name." состоится ".$game->date;

        $users = array_merge($game->home_team()->first()->users_subscribed()->all(),
                             $game->guest_team()->first()->users_subscribed()->all());
        foreach($users as $user)
        {
            send_Email(create_Email_letter($user->login, $message));
        }      
});

Player::afterUpdateObserver(function($player)
{    
        if( $player->original_data->team_id != $player->team_id )
        {
            $message = "Игрок ".$player->name." перешел из ".\Team::find($player->original_data->team_id)->name." в ".\Team::find($player->team_id)->name;
        }

        $users = array_merge(\Team::find($player->original_data->team_id)->users_subscribed()->all(),
                             \Team::find($player->team_id)->users_subscribed()->all());

        foreach($users as $user)
        {
            send_Email(create_Email_letter($user->login, $message));
        }
});


Player::afterCreateObserver(function($player)
{
        $message = "Игрок ".$player->name." появился в команде ".\Team::find($player->team_id)->name;

        $users = \Team::find($player->team_id)->users_subscribed()->all();

        foreach($users as $user)
        {
            send_Email(create_Email_letter($user->login, $message));
        } 
});

//Game::find(1)->save();

function app_run() {
    try
    {
        $route = get_route();

        if ($route = get_route())
        {
            require BASE_DIR.'/controllers/'.$route['file'];
            $handler = $route['namespace'].'\\'.$route['function'];
            $response = $handler();

            if (!is_array($response))
            {
                $response = ['code' => 200, 'body' => $response];
            }
        }
        else 
        {
            throw new NotFoundException();
        }
    }
    catch (NotFoundException $e)
    {
        $response = ['code' => 404, 'body' => view('errors/404')];
    }
    catch (WrongInputException $e)
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))) {
            $response = [
                'code' => 422, 
                'body' => json_encode($e->errors)
            ];
        }
        else
        {
            flash_set('old', $_POST);
            flash_set('errors', $e->errors);
            $response = redirect_back(); 
        }
    }
    catch (NotAllowedException $e)
    {
        $response = ['code' => 403, 'body' => view('errors/403')];
    }
    catch (NotAuthorizedException $e)
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))) {
            $response = [
                'code' => 403, 
                'body' => json_encode(['error' => 'You are not signed in. Please, sign in and refresh the page'])
            ];
        }
        else {
            flash_set('authorize_return_url', $_SERVER['REQUEST_URI']);
            $response = redirect(url_for('login'));
        }
    }

    catch (Exception $e)
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('xmlhttprequest'))) {
            $error = (ENV == 'dev') ? $e->getMessage()."\n".$e->getTraceAsString() : 'Sorry, some error occured';
            $response = [
                'code' => 500, 
                'body' => json_encode(['error' => $error])
            ];
        }
        else {
            $body = (ENV == 'dev') ? "<pre>".$e->getMessage()."\n".$e->getTraceAsString()."</pre>" : view('errors/500');
            $response = ['code' => 500, 'body' => $body];
        }        
    }

    return $response;
}