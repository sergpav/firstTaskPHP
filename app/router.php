<?php

class Router
{

	public $controller_action_name;

	public function start()
	{
		$uri = trim($_SERVER['REQUEST_URI'], '/');
		$uri = explode('/', $uri);

		if (empty($uri[0]) || $uri[0] == 'index') {
			$this->controller_action_name = 'index';
		} elseif ($uri[0] == 'login') {
			$this->controller_action_name = 'login';
		} elseif ($uri[0] == 'logout') {
			$this->controller_action_name = 'logout';
		} else {
			$this->page404();
		}

		if (file_exists('app/controller.php')) {
			include_once('app/controller.php');
		} else {
			$this->page404();
		}

		$controller = new Controller;
		if (method_exists($controller, $this->controller_action_name)) {
			$controller->{$this->controller_action_name}();
		} else {
			$this->page404();
		}
	}

	public function page404()
	{
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 Not Found');
		include_once('views/404.php');
		die();
	}

	public function redirect($data=null,$location=null)
	{
		if(!empty($data)) {
			$session = new Session;
			$session->addData('error' ,$data);
		}
		header('Location: /'.$location);
		die;
	}
}
