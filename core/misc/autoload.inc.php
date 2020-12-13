<?php
    spl_autoload_register(function($classname) {
        $path = '../core/classes/';
        $extension = '.class.php';
        $fullPath = $path . $classname . $extension;

        if (!file_exists($fullPath)) { echo $fullPath; }
        require_once $fullPath;
    });

    $db = new connect();
?>