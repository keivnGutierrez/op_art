<?php namespace Config;
    class Autoload{
        public static function startAutoload(){
            spl_autoload_register(function ($class)
            {
                # code...
                // $rute=$class;
                $route=str_replace('\\','/',$class).".php";
                require_once $route;
                // echo $route;
                // echo "<br>";
                // print($route);
                // echo "<br>";
            });
            }
    }