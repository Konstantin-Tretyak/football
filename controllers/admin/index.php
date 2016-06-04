<?php 

    namespace Controllers\Admin;

    function index()
    {
        validate_authorized();
        validate_authorized_as_admin();

        return view('admin', null, 'admin');
    }
?>