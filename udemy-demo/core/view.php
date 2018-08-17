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

}

?>