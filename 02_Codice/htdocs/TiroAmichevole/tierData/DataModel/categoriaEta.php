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

    public static function LoadDbData($idCatEta)
    {
      global $db;
      $sql = "SELECT * FROM CategoriaEta
              WHERE idCategoriaEta = '$idCatEta'";
      $rows = $db->query($sql);
      if ($r = $rows->fetch()){
        return CategoriaArma::Create($r["idCategoriaEta"], $r["descrizione"],
                                     $r["codice"], $r["etaMin"], $r["etaMax"]);
      }
      return NULL;
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
  }
  
  function findCatEta(&$listaCatEta, $ids = "",
                       $codiceCat = "", $descrizione = ""){
    global $db;
    $query = "";
    if ($codiceCat != ""){
      $query = " OR codiceCat LIKE '%$codiceCat%'";
    }
    if ($descrizione != ""){
      $query = " OR descrizione LIKE '%$descrizione%'";
    }
    $idList = implode(',', $ids);  
    if ($idList == ""){
      $idList = "0";
    }
    $sql = "SELECT * FROM `Licenze` 
            WHERE idLicenza IN ($idList) $query;";
    dbgTrace  ($sql);
    $rows = $db->query($sql);
    while ($r = $rows->fetch())
    {
      $id = $r['idCategoria'];
      $listaCatEta[$id] = CategoriaEta::LoadDbData($id);
    }
  }
  
  function catEtaForDataNascita(&$listaCatEta, $dataNascita){
    global $db;
    $age = date("Y") - date("Y", $dataNascita);
    $sql = "SELECT idCategoriaEta, etaMin, etaMax 
            FROM `CategoriaEta` 
            WHERE etaMin <= $age <= etaMax
            ORDER BY etaMin DESC";
    dbgTrace  ($sql);
    $rows = $db->query($sql);
    while ($r = $rows->fetch())
    {
      $id = $r['idCategoria'];
      $listaCatEta[$id] = CategoriaEta::LoadDbData($id);
    }
  }
  
  function allCatEta(&$listaCatEta){
    global $db;
    $sql = "SELECT idCategoriaEta, etaMin
            FROM `CategoriaEta` 
            ORDER BY etaMin ASC";
    dbgTrace  ($sql);
    $rows = $db->query($sql);
    while ($r = $rows->fetch())
    {
      $id = $r['idCategoriaEta'];
      $listaCatEta[$id] = CategoriaEta::LoadDbData($id);
    }
  }
?>