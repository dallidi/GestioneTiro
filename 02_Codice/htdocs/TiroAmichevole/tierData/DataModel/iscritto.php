<?php 
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // '/TierData/DataModel/iscritto.php';
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/licenza.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/categoriaArma.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/categoriaEta.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/societa.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/serie.php";
  require_once $_SERVER["DOCUMENT_ROOT"].
               '/TiroAmichevole/TierData/DbInterface/CommonDB.php';
  
  class Iscritto {
    public $Id;
    public $Licenza;
    public $CatArma;
    public $CatEta;
    public $Societa;
    public $Series;
    public $LastUpdate;
    
    public function __construct()
    {
      
    }
    
    public static function create($Id, $Licenza, $CatArma, $CatEta, $Societa,
                                  $Series)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Licenza = $Licenza;
      $instance->CatArma = $CatArma;
      $instance->CatEta = $CatEta;
      $instance->Societa = $Societa;
      $instance->Series = $Series;
      $instance->LastUpdate = sqlNow();
      return $instance;
    }

    public static function loadDbData(&$instances, $idIscritti,
                                      $nome = "", $cognome = "")
    {
      global $db;
      $ids = array_filter($idIscritti, 'is_int');
      $idList = implode(',', $ids);
      if ($idList == ""){
        $idList = "0";
      }
      $query = "Licenze_idLicenza IN ($idList)";    
      $sql = "SELECT * FROM `Iscrizioni` 
              WHERE $query";
      $rows = $db->query($sql);
      while ($r = $rows->fetch()){
        $idLic = intval($r["Licenze_idLicenza"]);
        unset($series);
        $series = array();
        $sqlS = "SELECT *
                 FROM Iscrizioni_has_Serie
                 WHERE Iscrizioni_Licenze_idLicenza = $idLic";
        $rowsS = $db->query($sqlS);
        while ($rs = $rowsS->fetch()){
          $series[] = Serie::serieDbData($rs["Serie_idSerie"]);
        }
        $instances[$idLic] = Iscritto::create($idLic, 
                   Licenza::licenceDbData($idLic),
                   CategoriaArma::loadDbData($r["CategoriaArmi_idCategoria"]),  
                   CategoriaEta::loadDbData($r["CategoriaEta_idCategoriaEta"]),
                   Societa::societaDbData($r["Societa_idSocieta"]),
                   $series);
     }
    }
    
    public function id(){
      return $this->Licenza->id();
    }
    
    public function nome(){
      return $this->Licenza->nome();
    }
    
    public function cognome(){
      return $this->Licenza->cognome();
    }
    
    public function dataNascita(){
      return $this->Licenza->dataNascita();
    }
    
    public function eta(){
      $an = intval(date_format(date_create($this->dataNascita()), "Y"));
      return intval(date("Y")) - $an;
    }
    
    public function indirizzo(){
      return $this->Licenza->indirizzo();
    }
    
    public function localita(){
      return $this->Licenza->localita();
    }
    
    public function listaSocieta(){
      return $this->Licenza->listaSocieta();
    }
    
    public function catArmaDescr(){
      return $this->CatArma->Descrizione;
    }
    
    public function catArmaId(){
      return $this->CatArma->catArmaId();
    }
    
    public function aggiornaDb(){
      global $db;
      
      $sql = "UPDATE Iscrizioni
              SET CategoriaArmi_idCategoria=".$this->CatArma->Id.",
                  CategoriaEta_idCategoriaEta=".$this->CatEta->Id.",
                  Societa_idSocieta=".$this->Societa->Id.",
                  lastUpdate='".sqlNow()."'
              WHERE Licenze_idLicenza=".$this->Id;
      $db->query($sql);

      $sql = "DELETE FROM Iscrizioni_has_Serie
              WHERE Iscrizioni_Licenze_idLicenza=".$this->Id;
      $db->query($sql);
      
      foreach($this->Series as $serie){
        $sql = "INSERT INTO Iscrizioni_has_Serie
                  (Iscrizioni_Licenze_idLicenza, Serie_idSerie)
                VALUES (".$this->Id.",".$serie->Id.")";
        $db->query($sql);
      }
    }

    public function aggiorna($catArmaId, $catEtaId, $societaId, $serieIds){
      $this->CatArma = CategoriaArma::loadDbData($catArmaId);
      $this->CatEta = CategoriaEta::loadDbData($catEtaId);
      $this->Societa = Societa::societaDbData($societaId);
      unset($this->Series);
      $this->Series = array();
      foreach($serieIds as $serieId){
        $this->Series[] = Serie::serieDbData($serieId);
      }
      $this->aggiornaDb();
    }

    public function fullName(){
      return $this->Licenza->Cognome . " " . $this->Licenza->Nome;
    }
    
    static function compFullName($a, $b) 
    {
      if (!$a and !$b){
        return 0;
      } else if (!$a){
        if ($b){
          return 1;
        }
      } else {
        if ($a){
          return -1;
        }
      }
      if ($a->Licenza->fullName() == $b->Licenza->fullName()){
        return 0;
      }elseif ($a->Licenza->fullName() < $b->Licenza->fullName()){
        return -1;
      }
      return 1;
    }
    
    public function hasSerie($idSerie){
      foreach($this->Series as $serie){
        if ($serie->Id == $idSerie){
          return true;
        }
      }
      return false;
    }
  } 
?>