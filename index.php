<?php

require("includes/wtframework/includes.php");

$router = new Router();

/*
*   WTFramework Welcome page
*/
$router->add("/", "pages/welcome.php");