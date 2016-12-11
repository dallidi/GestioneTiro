<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/categoriaArma.php";
  class CategoriaArma {
    public $Id;
    public $CodiceCat;
    public $Descrizione;
    
    public function categoriaArmaNil()
    {
    }

    public function __construct()
    {
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
      if ($r = $rows->fetch()){
        return CategoriaArma::Create($r["idCategoria"], 
                                     $r["codiceCat"], $r["descrizione"]);
      }
      return NULL;
    }
    
    public static function compCodiceCat($a, $b){
      if ($a->CodiceCat() == $b->CodiceCat()){
        return 0;
      }elseif ($a->CodiceCat() < $b->CodiceCat()){
        return -1;
      }
      return 1;
    }
  }
  
  function findCatArma(&$listaCatArma, $ids = "",
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
      $listaCatArma[$id] = CategoriaArma::LoadDbData($id);
    }
  }
  
  function allCatArma(&$listaCatArma){
    global $db;
    $sql = "SELECT idCategoria, codiceCat
            FROM `CategoriaArmi` 
            ORDER BY codiceCat ASC";
    dbgTrace  ($sql);
    $rows = $db->query($sql);
    while ($r = $rows->fetch())
    {
      $id = $r['idCategoria'];
      $listaCatArma[$id] = CategoriaEta::LoadDbData($id);
    }
  }
  
?>