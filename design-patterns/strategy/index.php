<?php
require 'PDOFactory.php';

interface Formater
{
  public function format($texte);
}

class TextFormater implements Formater
{
  public function format($texte) {
    return 'Date: ' . time() . "\n" . 'texte: ' . $texte;
  }
}

class XMLFormater implements Formater
{
  public function format($texte) {
    return '<?XML version="1.0" encoding="ISO-8859-1"?>'."\n".'<message>'."\n"."\t".'<date>'.time().'</date>'."\n"."\t".'<texte>'.$texte.'</texte>'."\n".'</message>';
  }
}

class HTMLFormater implements Formater
{
  public function format($texte) {
    return '<p><strong>Date:</strong> ' . time() . '<br />Text: ' . $texte . '</p>';
  }
}


abstract class Writer
{
  protected $formater;

  public function __construct($formater)
  {
    // hydratation
    $this->formater = $formater;
  }

  abstract public function write($texte);
}

class DBWriter extends Writer
{
  protected $db; // PDO

  public function __construct($formater, PDO $db)
  {
    $this->db = $db;
    $this->formater = $formater;
  }

  public function write($texte)
  {
    // écrit dans la base de données
    $q = $this->db->prepare('INSERT INTO message (texte) VALUES (:texte)');
    $q->bindValue(':texte', $this->formater->format($texte));
    $q->execute();
  }
}

class FileWriter extends Writer{
  protected $file;

  public function __construct($formater, $file)
  {
    $this->file = $file;
    $this->formater = $formater;
  }

  public function write($texte)
  {
    // écrit sur le disque (système de fichiers du serveur)
    $f = fopen($this->file, 'w');
    fwrite($f, $this->formater->format($texte));
    fclose($f);
  }
}

//$db_writer = new DBWriter(null, PDOFactory::getMysqlConnexion());
//$db_writer->write('La pizza est délicieuse');

$fw = new FileWriter(new TextFormater, 'message.txt');
//$fw->write('La pizza était mauvaise');

$f = new HTMLFormater();
echo $f->format('Je veux un ballon');

$dbw = new DBWriter(new HTMLFormater,  PDOFactory::getMysqlConnexion());
$dbw->write('La pizza est une invention napolitaine');










?>
