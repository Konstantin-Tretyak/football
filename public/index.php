<?php

// TODO: log requests and HTTP response codes.
//   Something like error_log($_SERVER["REQUEST_URI"]);
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();

require __DIR__.'/../app.php';