<?php

file_put_contents("lib-wtfframework.zip", fopen("https://codeload.github.com/fet1sov/WTFramework/zip/refs/heads/main", 'r'));

$zip = new ZipArchive;
if ($zip->open('lib-wtfframework.zip') === TRUE) {
    $zip->extractTo(__DIR__ . "\includes\wtframework");
    $zip->close();
}

unlink("lib-wtfframework.zip");
unlink("install.php");
unlink(__FILE__);