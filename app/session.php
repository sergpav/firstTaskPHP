<?php

class Session {
  public function addData($name,$data){
    $_SESSION[$name] = $data;
  }
  public function remData($name){
    unset($_SESSION[$name]);
  }
  public function isAuth(){
    if($_SESSION['isAuth'] == true) {
      return true;
    } else {
      return false;
    }
  }

  public function login($name) {
    $_SESSION['isAuth'] = true;
    $_SESSION['user'] = $name;
  }

  public function logout(){
    unset($_SESSION['isAuth'],$_SESSION['user']);
  }

  public function counter(){
    $_SESSION['authAtt'] += 1;
  }

  public function timount(){
    $_SESSION['unlockTime'] = strtotime('5 minutes');
  }
}