<?php

namespace Controllers\Auth;

function login()
{
    if ( get_authorized_user() )
    {
        return redirect_back();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
            validate_input($_POST, ['login', 'password']);

            if ( isset( $_POST['button_type'] ) && $_POST['button_type'] == "reg" )
            {
                registration();
            }

            $realUser = query("SELECT * FROM user WHERE login = :login AND password = :password",
                                array("login" => $_POST['login'], "password" => $_POST['password']),
                                connect());

            if ($realUser) // in real life, not passwords but their hashes should be compared
            {
                $_SESSION['user'] = $realUser[0];

                $redirect_url = flash_has('authorize_return_url') ? flash_get('authorize_return_url') : url_for('main');
                return redirect($redirect_url);
            }
            else {
                throw new \WrongInputException(['login' => 'Wrong login-password pair']);
            } 

        // return redirect_back();
    }

    return view('auth/login');
}

function logout()
{
    unset($_SESSION['user']);
    $_SESSION['message'] = 'You have logged out';
    return redirect_back();
}

function registration()
{
    query_for_change("INSERT INTO user(login, password) VALUES(:name, :password)",
                     array('name' => $_POST['login'], 'password' => $_POST['password']),
                     connect());
}