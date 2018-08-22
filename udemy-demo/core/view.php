<?php

namespace core;

class View{

    /**
     * Render the view file
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = "../app/views/$view";
        if(is_readable($file))
        {
            require $file;
        }
        else{
            throw new \Exception("view ($view) cannot be found");
        }
    }

    /**
     * Renders the template file from the Views folder
     * Twig template engine is used here.
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if($twig === null)
        {
            $loader = new \Twig_Loader_FileSystem('../app/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }

}

?>