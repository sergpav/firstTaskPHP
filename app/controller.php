<?php

class Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    $this->view = new View();
    $this->router = new Router();
    $this->session = new Session();
  }

  public function index()
  {
    if ($this->session->isAuth()) {
      $this->router->redirect(null, 'login');
    } else if($this->unlockTime() > 0) {
      $this->session->addData('error','System is locked, try again in '.$this->unlockTime().' seconds');
    } else if($this->unlockTime() <= 0) {
      $this->session->remData('unlockTime');
      $this->session->remData('authAtt');
    }
      
    $this->view->generate('indexPage.php', null);
    
  }

  public function login()
  {
    if($this->unlockTime() > 0) {
      $this->router->redirect(null, '/');
    }
    $name = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if (!empty($name) && !empty($password)) {
      $model = new Model;
      if ($model->getUser($name, $password)) {
        $this->session->login($name);
        $this->view->generate('loginPage.php', $name);
      } else {
        $this->session->counter();
        $this->router->redirect('Incorrect username or password');
      }
    } else if ($this->session->isAuth()) {
      $this->view->generate('loginPage.php', $_SESSION['user']);
    } else if ($_SESSION['authAtt'] >= 3) {
      $this->session->timount();
      $this->router->redirect('System is locked, try again in '.$this->unlockTime().' seconds');
    } else {
      $this->session->counter();
      $this->router->redirect('Empty username or password');
    }
  }

  public function logout()
  {
    $this->session->logout();
    $this->router->redirect();
  }

  public function unlockTime() 
  {
    return $_SESSION["unlockTime"] - strtotime('now');
  }
}
