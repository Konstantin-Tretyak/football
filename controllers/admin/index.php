<?php 

    namespace Controllers\Admin;

    function index()
    {
        validate_authorized();
        validate_authorized_as_admin();

        $data = null;
        
        return view('admin', $data, 'admin');
    }
?>