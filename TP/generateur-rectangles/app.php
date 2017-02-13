<?php

//var_dump($_POST);

class Rectangle {
  private $hauteur;
  private $largeur;
  private $couleur;

  public function __construct($params) {
    $this->hauteur = $params['hauteur'];
    $this->largeur = $params['largeur'];
    $this->couleur = $params['couleur'];
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

  public function genereDiv() {
    $css = 'margin:10px;';
    $css .= 'width:' . $this->getLargeur() . 'px;';
    $css .= 'height:' . $this->getHauteur() . 'px;';
    $css .= 'background-color:' . $this->getCouleur();

    if ($this->getLargeur() === $this->getHauteur()) {
      return '<div>La forme carée n\'est pas autorisée</div>';
    } else {
      return '<div style="'. $css .'"></div>';
    }

  }
}

$nb_rectangles = $_POST['rectangles']['nombre'];

for ($i=0; $i<$nb_rectangles; $i++) {
  $rectangle = new Rectangle($_POST['rectangles']);
  echo $rectangle->genereDiv();
}


?>
