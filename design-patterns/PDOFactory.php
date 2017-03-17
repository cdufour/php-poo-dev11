<?php
// Implémentation du Design Pattern Factory (Fabrique)
class PDOFactory
{
  public static function getMysqlConnexion()
  {
    $db = new PDO('mysql:host=localhost;dbname=formation-php-poo;charset=utf8', 'root', 'root');
    return $db;
  }

  public static function getPgsqlConnexion()
  {
    $db = new PDO('pgsql:host=http://serveurdistant.fr;dbname=autre-db;charset=utf8', 'admin', '1234');
    return $db;
  }
}

?>
