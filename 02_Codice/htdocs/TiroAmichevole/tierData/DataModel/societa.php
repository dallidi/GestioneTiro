<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/societa.php";
  require_once 'indirizzo.php';
  
  class Societa {
    public $Id;
    public $Codice;
    public $Nome;
    public $Indirizzo;
    public $Responsabile;
    
    public function societaNil()
    {
      $this->Id = 0;
      $this->Codice = "";
      $this->Nome = "";
      $this->Indirizzo = new Address;
      $this->Responsabile = "";
    }

    public function __construct()
    {
      $this->societaNil();
    }
    
    public static function Create($Id, $Codice, $Nome,
                                  $Via, $ViaNo, $Cap, $Luogo,
                                  $Responsabile)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Codice = $Codice;
      $instance->Nome = $Nome;
      $instance->Indirizzo->Via = $Via;
      $instance->Indirizzo->ViaNo = $ViaNo;
      $instance->Indirizzo->Cap = $Cap;
      $instance->Indirizzo->Luogo = $Luogo;
      $instance->Responsabile = $Responsabile;
      return $instance;
    }
    
    public static function LoadDbData($idSocieta)
    {
      global $db;
      $instance = new self();
      $sql = "SELECT * FROM Societa
              WHERE Societa.idSocieta = '$idSocieta'";
      $rows = $db->query($sql);
      $r = $rows->fetch();
      return Societa::Create(
                    $r["idSocieta"], $r["codiceSocieta"], $r["nome"],
                    $r["via"], $r["viaNo"], $r["CAP"], $r["luogo"],
                    $r["responsabile"]);
    }

    public function fullName(){
      return $this->Nome . " - " . $this->Luogo;
    }
  }
  
  function compSocName($a, $b)
  {
    if ($a->fullName() == $b->fullName()){
      return 0;
    }elseif ($a->fullName() < $b->fullName()){
      return -1;
    }
    return 1;
  }
?>