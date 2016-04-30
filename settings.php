<?php
    ///Base path to the something files
    define('ROOT_CATALOGUE', '/');
    define('BASE_DIR', __DIR__);


    $_ROUTES = [

        // TODO: move methods to classes and write like
        //       => ['class' => '\App\HomeController',  'method' => 'home'],
        //Openning pages
        '/'                    => ['file' =>'games_list.php', 'alias'=>'main'],
        '/login'               => ['file' =>'auth/login.php' , 'alias'=>'login'],
        '/club'                => ['file' =>'club_page.php', 'alias'=>'club'],
        '/game'                => ['file' =>'game.php', 'alias'=>'game'],
        //Admin pages
        '/admin'               => ['file' =>'admin/index.php', 'alias'=>'admin'],
        '/admin/teams/edit'    => ['file' =>'admin/teams/edit.php', 'alias'=>'admin_teams_edit'],
        '/admin/teams/new'     => ['file' =>'admin/teams/new.php', 'alias'=>'admin_teams_new'],
        '/admin/teams/index'   => ['file' =>'admin/teams/index.php', 'alias'=>'admin_teams'],
        '/admin/games/edit'    => ['file' =>'admin/games/edit.php', 'alias'=>'admin_games_edit'],
        '/admin/games/new'     => ['file' =>'admin/games/new.php', 'alias'=>'admin_games_new'],
        '/admin/games/index'   => ['file' =>'admin/games/index.php', 'alias'=>'admin_games'],
        '/admin/players/new'   => ['file' =>'admin/players/new.php', 'alias'=>'admin_players_new'],
        '/admin/players/edit'  => ['file' =>'admin/players/edit.php', 'alias'=>'admin_players_edit'],
    ];

    ///DATA BASE

    $another_page = false;

    $message_for_admin = array('teams_edit_name'=>'Название команды было измененно',
                                'teams_new'=>'Команда была созданна',
                                'games_edit'=>'Игра была изменена',
                                'games_new'=>'Игра была созданна',
                                'games_edit_not_start'=>'Матч ещё не начался, нельзя менять счет',
                                'players_edit'=>'Игрок был изменен',
                                'players_new'=>'Игрок был создан'
                                );

    $message_for_user = array('teams_add_to_user_liked'=>"Мы будем вам оповещать про все последние изменения в команде",
                              'teams_was_add_to_user_liked'=>"Теперь вы подписаны на команду ",
                              'teams_was_renamed'=>" был переименован в ",
                               'player_was_create'=>" появился игрок ");

    define('FILE_NAMES_EMAIL' ,"D:\\xampp\htdocs\\football\\email.txt");

    function connect()
    {
        $config = array('username' => 'root',
                        'password' => '');

        try
        {
            $conn = new PDO('mysql:host=localhost;dbname=foot',
                            $config['username'],
                            $config['password']);

            return $conn;
        }
        catch(Exception $e)
        {
            throw InternalServerException();
            return false;
        }
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
    function view($path, $data = null, $catalogue="")
    {
        show_admin_messages();

        $data['authorized_user'] = null;
        if (!empty($_SESSION['user_id'])) {
            // get user data from DB by id
            $data['authorized_user'] = ['id' => 1, 'login' => 'admin'];
        }

        $data['old_autorize'] = isset($_SESSION['old']) ? $_SESSION['old'] : [];

        $data['errors'] = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

        if ($data)
        {
            extract($data);
        }

        $path = BASE_DIR.'/view/'.$catalogue.'/'.$path.'.view.php';

        require BASE_DIR.'/view/'.$catalogue.'/layout.php';
    }

    ///admin view
    function show_admin_messages()
    {
        if(session_id() == "")
        {
            session_start();
        }
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
        public $code = 404;
    }

    class InternalServerException extends Exception
    {
        public $code = 500;
    }

    class WrongInputException extends Exception
    {
        public $errors;

        public function __construct($errors)
        {
            $this->errors = $errors;
        }
    }

    function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    function redirect_back()
    {
        redirect($_SERVER['HTTP_REFERER']);
    }


    function validate_input($input, $required_fields)
    {
        $errors = [];
        foreach ($required_fields as $field)
        {
            $_SESSION['old'][$field] = $input[$field];
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



    function url_for($alias)
    {
        global $_ROUTES;

        foreach ($_ROUTES as $url => $params)
        {
            if (isset($params['alias']) && $params['alias'] == $alias)
            {
                return $url;
            }
        }

        throw new Exception("Error Processing Request", 1);
    }

    function check_exist_url()
    {
        global $_ROUTES;

        $url_without_params = strtok($_SERVER["REQUEST_URI"],'?');

        foreach($_ROUTES as $url_template => $controller)
        {
            if ($url_template == $url_without_params)
            {
                return $controller['file'];
            }
        }

        throw new NotFoundException();
        return null;
    }
