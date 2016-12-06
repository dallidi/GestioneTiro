<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/categoriaEta.php";
  class CategoriaEta {
    public $Id;
    public $CodiceEta;
    public $Descrizione;
    public $EtaMax;
    public $EtaMin;
    
    public function categoriaArmaNil()
    {
      $this->Id = 0;
      $this->CodiceEta = "";
      $this->Descrizione = "";
      $this->EtaMax = 0;
      $this->EtaMin = 0;
    }

    public function __construct()
    {
      $this->categoriaArmaNil();
    }
    
    public static function Create($Id, $CodiceEta, $Descrizione, 
                                  $EtaMax, $EtaMin)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->CodiceEta = $CodiceEta;
      $instance->Descrizione = $Descrizione;
      $instance->EtaMax = $EtaMax;
      $instance->EtaMin = $EtaMin;
      return $instance;
    }

    public static function LoadDbData($idCatArma)
    {
      global $db;
      $sql = "SELECT * FROM CategoriaEta
              WHERE idCategoria = '$idCatArma'";
      $rows = $db->query($sql);
      $r = $rows->fetch();
      return CategoriaArma::Create($r["idCategoriaEta"], $r["descrizione"],
                                   $r["codice"], $r["etaMin"], $r["etaMax"]);
    }
  }
  
  function compEta($a, $b)
  {
    if ($a->EtaMin() == $b->EtaMin()){
      return 0;
    }elseif ($a->EtaMin() < $b->EtaMin()){
      return -1;
    }
    return 1;
  }
?>