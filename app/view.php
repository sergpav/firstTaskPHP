<?php

class View
{

  function generate($template_view, $data = null) 
  {
    include_once 'views/'.$template_view;
  }

}