<?php 
session_start();
error_reporting(-1);

require_once '../vendor/autoload.php';

$router = require '../src/App/Routes/index.php';

?>