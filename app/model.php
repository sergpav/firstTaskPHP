<?php

class Model
{
  public function __construct()
  {
    $this->data = file_get_contents('users.json');
    $this->data = json_decode($this->data);
  }

  public function getUser($name, $password) 
  {
    if(property_exists($this->data, $name) && $this->data->$name == $password) {
      return true;
    } else {
      return false;
    }
  }
}