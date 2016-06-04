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

            if ( isset( $_POST['action'] ) && $_POST['action'] == "register" )
            {
                $user = \User::create(['login' => $_POST['login'], 'password' => $_POST['password']]);
            }
            else {
                $user = \User::query()->where("login = ? AND password = ?", [$_POST['login'],$_POST['password']])->first();
            }

            if ($user) // in real life, not passwords but their hashes should be compared
            {
                $_SESSION['user'] = $user->toArray();

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
