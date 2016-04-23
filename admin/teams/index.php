<?php
    require '../../settings.php';
    //Connect to the DATA BASE
    $conn = connect($config);

    $data = null;

    $data['teams'] = query("SELECT * FROM teams ", array(), $conn);

    view('admin_teams' , $data, 'admin');
?>
