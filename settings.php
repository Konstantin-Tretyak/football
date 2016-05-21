<?php
    ///Base path to the something files
    define('ROOT_CATALOGUE', 'http://my_football.local:81');
    define('BASE_DIR', __DIR__);
    define('ENV', 'dev');


    function all_routes() {
        return [

            // TODO: move methods to classes and write like
            //       => ['class' => '\App\HomeController',  'method' => 'home'],
            //Openning pages
            '/'                    => ['file' =>'games_list.php', 'namespace' => 'Controllers\UserPages', 'function' => 'game_list_page', 'alias'=>'main'],
            '/club'                => ['file' =>'club_page.php', 'namespace' => 'Controllers\UserPages', 'function' => 'club_page', 'alias'=>'club'],
            '/game'                => ['file' =>'game.php', 'namespace' => 'Controllers\UserPages', 'function' => 'game_page', 'alias'=>'game'],
            //Login/logout
            '/login'               => ['file' =>'auth.php', 'namespace' => 'Controllers\Auth', 'function' => 'login',  'alias'=>'login'],
            '/logout'              => ['file' =>'auth.php', 'namespace' => 'Controllers\Auth', 'function' => 'logout', 'alias'=>'logout'],
            //Admin pages
            '/admin'               => ['file' =>'admin/index.php',  'namespace' => 'Controllers\Admin', 'function' => 'index',  'alias'=>'admin'],

            // TODO: autoloading (auto-require file by namespace)
            '/admin/teams/edit'    => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'edit',  'alias'=>'admin_teams_edit'],
            '/admin/teams/new'  => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'create',   'alias'=>'admin_teams_new'],
            '/admin/teams/index'   => ['file' =>'admin/teams.php', 'namespace' => 'Controllers\Admin\Teams', 'function' => 'index', 'alias'=>'admin_teams'],

            '/admin/games/edit'    => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'edit',  'alias'=>'admin_games_edit'],
            '/admin/games/new'     => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'create',   'alias'=>'admin_games_new'],
            '/admin/games/index'   => ['file' =>'admin/games.php', 'namespace' => 'Controllers\Admin\Games', 'function' => 'index',   'alias'=>'admin_games'],
            
            '/admin/players/new'   => ['file' =>'admin/players.php', 'namespace' => 'Controllers\Admin\Players', 'function' => 'create', 'alias'=>'admin_players_new'],
            '/admin/players/edit'  => ['file' =>'admin/players.php', 'namespace' => 'Controllers\Admin\Players', 'function' => 'edit', 'alias'=>'admin_players_edit'],
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

    define('FILE_NAMES_EMAIL' ,"D:\\xampp\htdocs\\football\\email.txt");

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

    function create_Email_letter($user, $letters)
    {
        $email_letter = "";

        foreach ($letters as $letter)
        {
            $email_letter .= date('Y-m-d H:i:s')." ".$user." ".$letter."\n";
        }

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
        // var_dump($request_url);
        // var_dump($_SERVER['HTTP_REFERER']);
        // TODO: fiex this logic
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
                if ($user['status'] != 'admin')
                {
                    throw new NotAllowedException();
                }
            }
            else
            throw new NotAuthorizedException(); 
        }

    /* middlewares end */