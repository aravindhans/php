<?php

namespace app\controllers;

class Home extends \core\BaseController
{
    protected function before(){
        // echo '(before)';
    }

    protected function after(){
        // echo '(after)';
    }

    public function indexAction(){
        //echo "calling index() method in Home";
        \core\View::render('home\index.php',[
            'name'=>'Arvind',
            'colors'=>['red','blue','green']
        ]);
    }

}

?>