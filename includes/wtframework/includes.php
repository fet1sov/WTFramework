<?php

/**
*   WTFFramework
*   github.com/fet1sov/WTFramework
*
*   @author fet1sov <prodaugust21@gmail.com>
*/

/* Loading all modules */
$modules = glob(__DIR__ . '/*.php');
foreach ($modules as $module) {
    require_once($module);
}