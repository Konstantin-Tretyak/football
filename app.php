<?php

/* APP INIT AREA. BEGIN */

    require __DIR__.'/settings.php';

    //Connect to the DATA BASE
    $conn = connect();

    try {
        require BASE_DIR.'/controllers/'.check_exist_url();
    }
    catch (NotFoundException $e) {
        http_response_code(404);
        require BASE_DIR.'/controllers/error/error.php';
    }
    catch (WrongInputException $e) {
        http_response_code(302);
        $_SESSION['errors'] = $e->errors;

        redirect_back();
    }
    catch (InternalServerException $e) {
        http_response_code(500);
    }
    /* routing code. end */

/* APP INIT AREA. END */

/* CONTROLLERS AREA. BEGIN */
    // TODO NEXT VERSIONS: this area should be moved to separate place

    // TODO NEXT COMMIT: take HTML from HTML files
    function home() {
        return '
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="/css/main.css">
            </head>
            <body>
                home page
            </body>
            </html>';
    }

    function posts_index() {
        return '
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="/css/main.css">
            </head>
            <body>
                posts page
            </body>
            </html>';
    }

    function posts_new() {
        return '
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="/css/main.css">
            </head>
            <body>
                form to add a new post
            </body>
            </html>';
    }
/* CONTROLLERS AREA. END */