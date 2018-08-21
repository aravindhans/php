<?php

namespace core;

class View{

    public static function render($view, $args = []){
        extract($args,EXTR_SKIP);
        $file = "../app/views/$view";
        if(is_readable($file)){
            require $file;
        }else{
            echo "view ($view) cannot be found";
        }
    }

    public static function renderTemplate($template, $args = []){
        static $twig = null;

        if($twig === null){
            $loader = new \Twig_Loader_FileSystem('../app/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template,$args);
    }

}

?>