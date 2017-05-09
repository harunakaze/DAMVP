<?php
// AUTOLOAD THEM ALL
spl_autoload_register(function ($file) {
    $paths = array(
        'controller/',
        'model/'
    );

    foreach($paths as $path) {
        if(file_exists($path . $file . '.php')) {
            include $path . $file . '.php';
        }
    }
});
?>