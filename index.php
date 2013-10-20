<?php
include 'init.php';

define('MODULE',(isset($_GET['m']) && $_GET['m'] !=='')? trim($_GET['m']) : DEFAULT_MODULE);

define('CONTROLLER',(isset($_GET['c']) && $_GET['c'] !=='')? trim($_GET['c']) : DEFAULT_CONTROLLER);

define('ACTION',(isset($_GET['a']) && $_GET['a'] !=='')? trim($_GET['a']) : 'index');

App::run();