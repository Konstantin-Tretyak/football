<?php

    ///Base path to the something files
    define('ROOT_CATALOGUE', 'http:\\\localhost\football');


    ///DATA BASE
    $config = array('username' => 'root',
                    'password' => '');

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

    function connect($config)
    {
        try
        {
            $conn = new PDO('mysql:host=localhost;dbname=foot',
                            $config['username'],
                            $config['password']);

            return $conn;
        }
        catch(Exception $e)
        {
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

        if ($data)
        {
            extract($data);
        }

        $path = $path.'.view.php';

        include 'view\\'.$catalogue.'\layout.php';
    }

    ///admin view
    function show_admin_messages()
    {
        if(session_id() == "") 
        { 
            session_start();
        } 
        if (!empty($_SESSION))
        {
            foreach ($_SESSION as $message)
            {
                echo $message;
            }
        } 
        $_SESSION = array();
    }

    function wright_message($message)
    {
        $_SESSION[]=$message;
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