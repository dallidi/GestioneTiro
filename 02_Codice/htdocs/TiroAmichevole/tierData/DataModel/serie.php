<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/TierData/DataModel/serie.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/bersaglio.php";
  
  class Serie {
    public $Id;
    public $Codice;
    public $Descrizione;
    public $Bersaglio;
    public $NoColpi;
    public $Fattore;  // x es. 0.1 per rimborso 1/100 -> 1 / 10
    
    public function __construct()
    {
    }
    
    public static function Create($Id, $Codice, $Descrizione, $Bersaglio,
                                  $NoColpi, $Fattore)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Codice = $Codice;
      $instance->Descrizione = $Descrizione;
      $instance->Bersaglio = $Bersaglio;
      $instance->NoColpi = $NoColpi;
      $instance->Fattore = $Fattore;
      return $instance;
    }
    
    public static function loadDbData(&$instances, $idSerie,
                                      $codice = "", $descrizione = "")
    {
      global $db;
      $idList = implode(',', $idSerie);
      $orderBy = "ORDER BY idSerie";
      if ($idList == ""){
        $idList = "0";
      }
      $query = "idSerie IN ($idList)";
      if ($descrizione != ""){
        $query = "$query OR descrizione LIKE '%$descrizione%'";
        $orderBy = "ORDER BY descrizione";
      }
      if ($codice != ""){
        $query = "$query OR codice LIKE '%$codice%'";
        $orderBy = "ORDER BY codice";
      }
      $sql = "SELECT *
              FROM Serie
              WHERE $query";
      dbgTrace($sql);
      $rows = $db->query($sql);
      while ($r = $rows->fetch())
      {
        $bersaglio = bersaglioDbData($r["Bersagli_idBersaglio"]);
        $id = $r["idSerie"];
        $instances[$id] = 
          Serie::Create($id, $r["codice"], $r["descrizione"],
                        $bersaglio, $r["noColpi"], $r["fattore"]);
      }
    }
    
    public static function serieDbData($id){
      if (!$id){
        return NULL;
      }
      $series = array();
      $ids = array($id);
      Serie::loadDbData($series, $ids);
      if (count($series) != 1){
        dbgTrace("ERROR", "Id serie non univoco $id.");
        throw new Exception("Serie non univoca $id.");
      }
      return reset($series);
    }
  }
  
  function compDescrizione($a, $b)
  {
    if ($a->Descrizione == $b->Descrizione){
      return 0;
    }elseif ($a->Descrizione < $b->Descrizione){
      return -1;
    }
    return 1;
  }
  
  function allSerie(&$listaSerie){
    global $db;
    $sql = "SELECT idSerie, descrizione
            FROM `Serie` 
            ORDER BY descrizione ASC";
    dbgTrace  ($sql);
    $rows = $db->query($sql);
    while ($r = $rows->fetch())
    {
      $id = $r['idSerie'];
      $serie = Serie::serieDbData($id);
      $listaSerie[$id] = $serie; 
    }
  }
  
?>