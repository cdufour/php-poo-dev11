<?php

function __autoload($class)
{
  $dirs = array('classes/', 'classes/Module1/');
  foreach($dirs as $dir) {
    $searched_class = $dir . $class . '.php';
    if (file_exists($searched_class))
      require $searched_class;
  }
}

?>
