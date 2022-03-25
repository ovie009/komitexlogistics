<?php

    spl_autoload_register("myAutoloader");
    
    function myAutoloader($className){

        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        if (strpos($url, "includes") == true || strpos($url, "refresh") == true ) {
            $path = "../classes/";
        } else {
            $path = "classes/";
        }
        
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;

        if (!file_exists($fullPath) ) {
            return false;
        }
        
        include_once $fullPath;
    }

    // echo 'Hi<br>';


?>