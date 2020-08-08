<?php
ini_set('display_errors', 1);
if (!session_id()) {
  session_start();
}

require_once 'app/model.php';
require_once 'app/view.php';
require_once 'app/controller.php';
require_once 'app/router.php';
require_once 'app/session.php';

$router = new Router;
$router->start();

date_default_timezone_set('Europe/Kiev');
