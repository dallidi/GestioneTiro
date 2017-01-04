<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/TierData/DataModel/bersaglio.php";
  
  class Bersaglio {
    public $Id;
    public $Codice;
    public $Tipo;
    public $MaxPunti;
    
    public function __construct()
    {
    }
    
    public static function Create($Id, $Codice, $Tipo, $MaxPunti)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Codice = $Codice;
      $instance->Tipo = $Tipo;
      $instance->MaxPunti = $MaxPunti;
      return $instance;
    }
    
    public static function loadDbData(&$instances, $idBersaglio,
                                      $codice = "", $tipo = "")
    {
      global $db;
      $idList = implode(',', $idBersaglio);
      $orderBy = "ORDER BY idBersaglio";
      if ($idList == ""){
        $idList = "0";
      }
      $query = "idBersaglio IN ($idList)";
      if ($codice != ""){
        $query = "$query OR codice LIKE '%$codice%'";
        $orderBy = "ORDER BY codice";
      }
      if ($tipo != ""){
        $query = "$query OR tipo LIKE '%$tipo%'";
        $orderBy = "ORDER BY tipo";
      }
      $sql = "SELECT *
              FROM Bersagli
              WHERE $query";
      $rows = $db->query($sql);
      while ($r = $rows->fetch())
      {
        $instances[$id] = 
          Bersaglio::Create($r["idBersaglio"], $r["codice"], $r["tipo"],
                            $r["maxPunti"]);
      }
    }
  }
  
  function compTipo($a, $b)
  {
    if ($a->Tipo == $b->Tipo){
      return 0;
    }elseif ($a->Tipo < $b->Tipo){
      return -1;
    }
    return 1;
  }

  function bersaglioDbData($id){
    if (!$id){
      return NULL;
    }
    $bersagli = array();
    $ids = array($id);
    Societa::loadDbData($bersagli, $ids);
    if (count($bersagli) != 1){
      dbgTrace("ERROR", "Id bersaglio non univoco $id.");
      throw new Exception("Bersaglio non univoco $id.");
    }
    return reset($bersagli);
  }
  
?>