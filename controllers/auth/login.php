<?php
$realUser = ['id' => 1, 'login' => 'admin', 'password' => '123'];        // should be taken from DB

// session_start();
if (isset($_POST['logout'])) 
{
     unset($_SESSION['user']);
     session_destroy();
     $message = 'Вы разлогинились!';
}

// $loggedIn = isset($_SESSION['user']);
else
{
    // validate begin
        validate_input($_POST, ['login', 'password']);
    // validate end

    // in real world - search users table by login and password
    if (   $_POST['login'] == $realUser['login']
        && $_POST['password'] == $realUser['password']) // in real life, not passwords but their hashes should be compared
    {
        $_SESSION['user_id'] = $realUser['id'];
    }
    else {
        // TODO: завести графу 'common', которую отображать в отдельном месте в начале формы
        throw new WrongInputException(['login' => 'Wrong login-password pair']);
    }
}

redirect_back();
