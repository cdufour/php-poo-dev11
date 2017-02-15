<?php

class Rectangle {
  private $hauteur;
  private $largeur;
  private $couleur;

  public function __construct($params) {
    $this->hauteur = $params['hauteur'];
    $this->largeur = $params['largeur'];

    // opérateur ternaire (expression booléenne) ? instruction si vrai : instruction si faux
    $this->couleur = ($params['couleur'] == 0)
      ? $this->couleurAleatoire() : $params['couleur'];

    if ($this->estCarre()) {
      throw new Exception('La forme carrée n\'est pas autorisée');
    }

  }

  public function getHauteur() {
    return $this->hauteur;
  }
  public function getLargeur() {
    return $this->largeur;
  }
  public function getCouleur() {
    return $this->couleur;
  }

  private function estCarre() {
    return $this->getLargeur() === $this->getHauteur();
  }

  private function couleurAleatoire() {
    $couleurs = array('red', 'green', 'blue', 'orange', '#44ff66');
    $index = rand(0, sizeof($couleurs) - 1);
    return $couleurs[$index];
  }

  public function genereDiv() {
    $css = 'margin:10px;';
    $css .= 'width:' . $this->getLargeur() . 'px;';
    $css .= 'height:' . $this->getHauteur() . 'px;';
    $css .= 'background-color:' . $this->getCouleur();

    return '<div style="'. $css .'"></div>';
  }
}

$nb_rectangles = $_POST['rectangles']['nombre'];

for ($i=0; $i<$nb_rectangles; $i++) {
  try {
    $rectangle = new Rectangle($_POST['rectangles']);
    echo $rectangle->genereDiv();
  } catch (Exception $e) {
    echo $e->getMessage();
    break;
  }

}

?>
