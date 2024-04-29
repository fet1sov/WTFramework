<?php

require("includes/wtframework/includes.php");

define("BACKEND_DIR", "backend/");

$router = new Router();

/*
*   WTFramework Welcome page
*/
$router->add("/", BACKEND_DIR . "welcome.ctrl.php");