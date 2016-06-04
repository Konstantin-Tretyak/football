<?php
    ///Base path to the something files
    define('ROOT_CATALOGUE', 'http://my_football.local:81');
    define('BASE_DIR', __DIR__);
    define('ENV', 'dev');
    define('FILE_NAMES_EMAIL' ,"D:\\xampp\htdocs\\football_with_controllers\\email.txt");

    function all_routes() {
        return [

            // TODO: move methods to classes and write like
            //       => ['class' => '\App\HomeController',  'method' => 'home'],
            //Openning pages
            '/'                    => ['file' =>'game.php', 'namespace' => 'Controllers\Game', 'function' => 'index', 'alias'=>'main'],
            '/user'                => ['file' => 'user.php', 'namespace' => 'Controllers\User', 'function' => 'show', 'alias'=>'user'],
            '/club'                => ['file' =>'team.php', 'namespace' => 'Controllers\Team', 'function' => 'show', 'alias'=>'club'],
            '/game'                => ['file' =>'game.php', 'namespace' => 'Controllers\Game', 'function' => 'show', 'alias'=>'game'],
            //Login/logout
            '/login'               => ['file' =>'auth.php', 'namespace' => 'Controllers\Auth', 'function' => 'login',  'alias'=>'login'],
            '/logout'              => ['file' =>'auth.php', 'namespace' => 'Controllers\Auth', 'function' => 'logout', 'alias'=>'logout'],
            
            '/comments/create_entity'      => ['file' =>'comment.php', 'namespace' => 'Controllers\Comment', 'function' => 'create_entity', 'alias'=>'create_comment'],


            //Admin pages
            '/admin'               => ['file' =>'admin/index.php',  'namespace' => 'Controllers\Admin', 'function' => 'index',  'alias'=>'admin'],

            // TODO: autoloading (auto-require file by namespace)
            '/admin/teams/edit'    => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'edit',  'alias'=>'admin_teams_edit'],
            '/admin/teams/edit_entity'    => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'edit_entity',  'alias'=>'admin_teams_edit_entity'],
            '/admin/teams/create'  => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'create',   'alias'=>'admin_teams_new'],
            '/admin/teams/create_entity'  => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'create_entity',   'alias'=>'admin_teams_create_entity'],
            '/admin/teams/index'   => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'index', 'alias'=>'admin_teams'],

            '/admin/games/edit'    => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'edit',  'alias'=>'admin_games_edit'],
            '/admin/games/edit_entity'    => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'edit_entity',  'alias'=>'admin_games_edit_entity'],
            '/admin/games/create'     => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'create',   'alias'=>'admin_games_new'],
            '/admin/games/create_entity' => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'create_entity',   'alias'=>'admin_games_create_entity'],
            '/admin/games/index'   => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'index',   'alias'=>'admin_games'],
            
            '/admin/players/create'   => ['file' =>'admin/players.php', 'namespace' => 'Controllers\Admin\Players', 'function' => 'create', 'alias'=>'admin_players_new'],
            '/admin/players/create_entity' => ['file' =>'admin/players.php', 'namespace' => 'Controllers\Admin\Players', 'function' => 'create_entity', 'alias'=>'admin_players_create_entity'],

            '/admin/players/edit' => ['file' =>'admin/players.php', 'namespace' => 'Controllers\Admin\Players', 'function' => 'edit', 'alias'=>'admin_players_edit'],
            '/admin/players/edit_entity' => ['file' =>'admin/players.php', 'namespace' => 'Controllers\Admin\Players', 'function' => 'edit_entity', 'alias'=>'admin_players_edit_entity'],

            '/teams/subscribe' => ['file' => 'team.php', 'namespace' => 'Controllers\Team', 'function' => 'subscribe', 'alias'=>'subscribe_team'],
        ];
    }

    function message_for_admin()
    {
        return array('teams_edit_name'=>'Название команды было измененно',
                     'teams_new'=>'Команда была созданна',
                     'games_edit'=>'Игра была изменена',
                     'games_new'=>'Игра была созданна',
                     'games_edit_not_start'=>'Матч ещё не начался, нельзя менять счет',
                     'players_edit'=>'Игрок был изменен',
                     'players_new'=>'Игрок был создан'
                    );
    }

    ///DATA BASE

    $another_page = false;

    function connect()
    {
        $config = array('username' => 'root',
                        'password' => '');

        $conn = new PDO('mysql:host=localhost;dbname=foot',
                        $config['username'],
                        $config['password']);

        return $conn;
    }

    function query($query, $bindings, $conn)
    {
        $statement = $conn->prepare($query);
        $statement->execute($bindings);

        return $statement->fetchAll();
    }

    function query_for_change($query, $bindings, $conn)
    {
        $statement = $conn->prepare($query);
        $statement->execute($bindings);

        return $statement->fetchAll();
    }

    function get_by_id($id, $tableName , $conn)
    {
        return query("SELECT * FROM $tableName WHERE id = :id",
                    array('id' => $id),
                    $conn);
    }

    ////end DATA BASE

    ///work with page
    // TODO: remove $catalogue
    function view($path, $data = null, $catalogue="")
    {
        echo flash_get('message');

        $data['authorized_user'] = get_authorized_user();
        $data['current_user'] = get_auth_user();

        $data['old'] = flash_get('old');

        $data['errors'] = flash_get('errors');

        if ($data)
        {
            extract($data);
        }

        ob_start();
        $path = BASE_DIR.'/view/'.$catalogue.'/'.$path.'.view.php';
        require BASE_DIR.'/view/'.$catalogue.'/layout.php';
        return ob_get_clean();
    }

    ///admin view
    function show_admin_messages()
    {
        if (!empty($_SESSION['message']))
        {
            echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    }

    ///end admin view
    ///end work with page

    ///JSON function
    function creat_JSON_file($json_string, $file_name)
    {
        $handle = fopen($file_name, "w+");

        fwrite($handle, $json_string);

        fclose($handle);
    }
    ///End JSON function

    ///Email gag

    function create_Email_letter($user, $letter)
    {
        $email_letter = "";

            $email_letter .= date('Y-m-d H:i:s')." ".$user." ".$letter."\n";

        return $email_letter;
    }


    function send_Email($letter)
    {
        if ( file_exists(FILE_NAMES_EMAIL) )
        {
            $handle = fopen(FILE_NAMES_EMAIL, "a");
        }
        else
        {
            $handle = fopen(FILE_NAMES_EMAIL, "w");
        }

        fwrite($handle, $letter);

        fclose($handle);

    }
    ///End Email gag

    ///constant
    define('LIMIT_VIEW_GAMES_INDEX_PAGE', 5);

    function url($path)
    {
        return ROOT_CATALOGUE.$path;
    }

    class NotFoundException extends Exception
    {
    }

    class InternalServerException extends Exception
    {
    }

    class NotAllowedException extends Exception
    {
    }

    class WrongInputException extends Exception
    {
        public $errors;

        public function __construct($errors)
        {
            $this->errors = $errors;
        }
    }

    class NotAuthorizedException extends Exception
    {
    }

    function redirect($url)
    {
        return ['code' => 302, 'headers' => ['Location' => $url]];
    }

    function redirect_back()
    {
        $request_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        $url = (isset($_SERVER['HTTP_REFERER']) && ($request_url != $_SERVER['HTTP_REFERER']))
                ? $_SERVER['HTTP_REFERER']
                : url_for('main');
        return redirect($url);
    }


    function validate_input($input, $required_fields)
    {
        $errors = [];
        foreach ($required_fields as $field)
        {
            if (empty($input[$field]))
            {
                $errors[$field] = 'Field is required';
            }
        }

        if ($errors)
        {
            throw new WrongInputException($errors);
        }
    }



    // TODO: return url($url) => no need to write url(url_for('admin_edit')) in templates
    function url_for($alias)
    {
        foreach (all_routes() as $url => $params)
        {
            if (isset($params['alias']) && $params['alias'] == $alias)
            {
                return $url;
            }
        }

        throw new Exception('Wrong alias '+$alias);
    }

    function get_route()
    {
        $url_without_params = strtok($_SERVER["REQUEST_URI"],'?');

        foreach(all_routes() as $url_template => $route_params)
        {
            if ($url_template == $url_without_params)
            {
                return $route_params;
            }
        }

        return null;
    }

    function flash_set($param, $value) {
        $_SESSION['flash'][$param] = $value;
    }

    function flash_has($param) {
        return isset($_SESSION['flash'][$param]);
    }

    function flash_get($param) {
        if (flash_has($param)) {
            $result = $_SESSION['flash'][$param];
            unset($_SESSION['flash'][$param]);
            return $result;
        }
        return null;
    }

    function get_authorized_user() {
        if (!empty($_SESSION['user'])) {
            // get user data from DB by id
            return $_SESSION['user'];
        }
        return null;
    }

    // TODO: use this instead of get_authorized_user
    function get_auth_user() {
        if (!empty($_SESSION['user'])) {
            return \User::find($_SESSION['user']['id']);
        }
        return null;
    }

    /* middlewares begin */
        function validate_authorized()
        {
            if (!get_authorized_user())
            {
                throw new NotAuthorizedException();
            }
        }

        function validate_authorized_as_admin()
        {
            $user = get_authorized_user();

            if ($user)
            {
                if (!$user['is_admin'])
                {
                    throw new NotAllowedException();
                }
            }
            else {
                throw new NotAuthorizedException(); 
            }
        }

        function is_user_club($id)
        {
            $user_teams = \UserTeam::query()->where("user_id=?",[get_authorized_user()['id']])->all();
            if(!empty($user_teams))
            foreach ($user_teams as $user_team)
            {
                if($user_team->team_id === $id)
                    return true;
            }

            return false;
        }

        function get_pagination_page_number($page)
        {
            return $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }

function sgp($url, $varname, $value) // substitute get parameter
{
     if (is_array($varname))
     {
         foreach ($varname as $i => $n)
         {
            $v = (is_array($value))
                  ? ( isset($value[$i]) ? $value[$i] : NULL ) 
                  : $value;
            $url = sgp($url, $n, $v);
         }
         return $url;
     }
     
    preg_match('/^([^?]+)(\?.*?)?(#.*)?$/', $url, $matches);
    $gp = (isset($matches[2])) ? $matches[2] : ''; // GET-parameters
    //if (!$gp) return $url;
    
    $pattern = "/([?&])$varname=.*?(?=&|#|\z)/";
    
    if (preg_match($pattern, $gp))
    {
        $substitution = ($value !== '') ? "\${1}$varname=" . preg_quote($value) : '';
        $newgp = preg_replace($pattern, $substitution, $gp); // new GET-parameters
        $newgp = preg_replace('/^&/', '?', $newgp); 
    }
    else
    {
        $s = ($gp) ? '&' : '?';
        $newgp = $gp.$s.$varname.'='.$value;
    }
   
        $anchor = (isset($matches[3])) ? $matches[3] : '';
        $newurl = $matches[1].$newgp.$anchor;
        return $newurl;
    }

    function dd($var) {
        var_dump($var);die();
    }
    /* middlewares end */