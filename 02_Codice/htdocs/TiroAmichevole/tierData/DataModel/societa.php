<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/TierData/DataModel/societa.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/indirizzo.php";
  
  class Societa {
    public $Id;
    public $Codice;
    public $Nome;
    public $Indirizzo;
    public $Responsabile;
    
    public function __construct()
    {
    }
    
    public static function Create($Id, $Codice, $Nome,
                                  $Indirizzo,
                                  $Responsabile)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Codice = $Codice;
      $instance->Nome = $Nome;
      $instance->Indirizzo = $Indirizzo;
      $instance->Responsabile = $Responsabile;
      return $instance;
    }
    
    public static function loadDbData(&$instances, $idSocieta,
                                      $nome = "", $luogo = "")
    {
      global $db;
      $idList = implode(',', $idSocieta);
      $orderBy = "ORDER BY idSocieta";
      if ($idList == ""){
        $idList = "0";
      }
      $query = "idSocieta IN ($idList)";
      if ($nome != ""){
        $query = "$query OR nome LIKE '%$nome%'";
        $orderBy = "ORDER BY nome";
      }
      if ($luogo != ""){
        $query = "$query OR luogo LIKE '%$luogo%'";
        $orderBy = "ORDER BY luogo";
      }
      $idList = implode(',', $idSocieta);  
      if ($idList == ""){
        $idList = "0";
      }
      $sql = "SELECT *
              FROM Societa
              WHERE $query";
      $rows = $db->query($sql);
      while ($r = $rows->fetch())
      {
        $id = $r["idSocieta"];
        $indirizzo = Indirizzo::create($r["via"], $r["viaNo"],
                                       $r["cap"], $r["luogo"]);
        $instances[$id] = 
          Societa::Create($r["idSocieta"], $r["codiceSocieta"], $r["nome"],
                          $indirizzo, $r["responsabile"]);
      }
    }
    
    
    public static function societaDbData($id){
      if (!$id){
        return NULL;
      }
      $societa = array();
      $ids = array($id);
      Societa::loadDbData($societa, $ids);
      if (count($societa) != 1){
        dbgTrace("ERROR", "Tiratore non univoco $id. ". $societa);
        throw new Exception("Tiratore non univoco $id. $societa");
      }
      return reset($societa);
    }

    public function fullName(){
      return $this->Nome . " - " . $this->Indirizzo->Luogo;
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