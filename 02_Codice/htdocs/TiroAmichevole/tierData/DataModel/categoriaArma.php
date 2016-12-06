<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/categoriaArma.php";
  class CategoriaArma {
    public $Id;
    public $CodiceCat;
    public $Descrizione;
    
    public function categoriaArmaNil()
    {
      $this->Id = 0;
      $this->CodiceCat = "";
      $this->Descrizione = "";
    }

    public function __construct()
    {
      $this->categoriaArmaNil();
    }
    
    public static function Create($Id, $CodiceCat, $Descrizione)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->CodiceCat = $CodiceCat;
      $instance->Descrizione = $Descrizione;
      return $instance;
    }
    
    public static function LoadDbData($idCatArma)
    {
      global $db;
      $sql = "SELECT * FROM CategoriaArmi
              WHERE idCategoria = '$idCatArma'";
      $rows = $db->query($sql);
      $r = $rows->fetch();
      return CategoriaArma::Create($r["idCategoria"], 
                                   $r["codiceCat"], $r["descrizione"]);
    }
  }
  
  function compCodiceCat($a, $b)
  {
    if ($a->CodiceCat() == $b->CodiceCat()){
      return 0;
    }elseif ($a->CodiceCat() < $b->CodiceCat()){
      return -1;
    }
    return 1;
  }
?>