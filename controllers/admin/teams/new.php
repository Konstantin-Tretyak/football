<?php
    $data = null;

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        query_for_change("INSERT INTO teams(name) VALUES(:name)",
              array('name' => $_POST['name']),
              $conn);

        $_SESSION['message']=$message_for_admin['teams_new'];

        if(isset($_POST['page']))
        {
            header("Location: {$_POST['page']}");
            exit();
        }
    }

    view('admin_teams_new', $data, 'admin');
?>