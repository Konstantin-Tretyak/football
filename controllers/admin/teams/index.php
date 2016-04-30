<?php
    $data = null;

    $data['teams'] = query("SELECT * FROM teams ", array(), $conn);

    view('admin_teams' , $data, 'admin');
?>
