<!-- <h1>PHP Demo</h1> -->
<?php

	// require '../app/controllers/posts.php';

	// require '../core/router.php';

	//autoloader
	spl_autoload_register(function ($class){
		$root = dirname(__DIR__);
		$file = $root.'/'.str_replace('\\','/',$class).'.php';
		if(is_readable($file)){
			require $file;
		}
	});

	$router = new core\Router();

	$router->add('',['controller'=>'home','action'=>'index']);
	//$router->add('posts',['controller'=>'posts','action'=>'index']);
	// $router->add('posts/new',['controller'=>'posts','action'=>'new']);
	$router->add('{controller}/{action}'); //eg: posts/new
	$router->add('admin/{action}/{controller}',['namespace'=>'admin']); //eg: admin/new/user
	$router->add('{controller}/{id:\d+}/{action}');

	// echo "<pre>";
	// var_dump($router->getRoutes());
	

	// $url = $_SERVER['QUERY_STRING'];

	// if($router->match($url)){
	// 	var_dump($router->getParams());
	// }else{
	// 	echo("route is not found '$url'");
	// }

	// echo "</pre>";

	// echo "<pre>";
	$router->dispatch($_SERVER['QUERY_STRING']);

	// echo "</pre>";
?>