<?php 
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // '/TierData/DataModel/tiratore.php';
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/licenza.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/categoriaArma.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/categoriaEta.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/societa.php";
  require_once $_SERVER["DOCUMENT_ROOT"].
               '/TiroAmichevole/TierData/DbInterface/CommonDB.php';
  
  class Tiratore {
    public $Licenza;
    public $CatArma;
    public $CatEta;
    public $Societa;
    public $Serie;
    
    public function tiratoreNil()
    {
      $this->Licenza = new Licenza();
      $this->CatArma = new CategoriaArma();
      $this->CatEta = new CategoriaEta();
      $this->Societa = new Societa();
      $this->Serie = array();
    }

    public function __construct()
    {
      $this->tiratoreNil();
    }
    
    public static function Create($Licenza, $CatArma, $CatEta, $Societa, $Serie)
    {
      $instance = new self();
      $instance->Licenza = $Licenza;
      $instance->CatArma = $CatArma;
      $instance->CatEta = $CatEta;
      $instance->Societa = $Societa;
      $instance->Serie = $Serie;
      return $instance;
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
    
    public static function LoadDbData($idLic)
    {
      global $db;
      $sql = "SELECT * FROM Iscrizioni
              WHERE Iscrizioni.Licenze_idLicenza = '$idLic'";
      $rows = $db->query($sql);
      $r = $rows->fetch();
      
      $licId = $r["Licenze_idLicenza"];
      $instance->Licenza = Licenza::LoadDbData($licId);
      $idCatArma = $r["CategoriaArmi_idCategoria"];
      if ($idCatArma){
        $instance->CatArma = CategoriaArma::LoadDbData($idCatArma);
      }
      $idCatEta = $r["CategoriaEta_idCategoriaEta"];
      if ($idCatEta){
        $instance->CatEta = CategoriaEta::LoadDbData($idCatEta);
      }
      $idSoc = $r["Societa_idSocieta"];
      if ($idSoc){
        $instance->Societa = Societa::LoadDbData($idSoc);
      }
      
      $sql = "SELECT * FROM Inscrizioni_has_Serie AS IscrSerie
              WHERE IscrSerie.Inscrizioni_Licenze_idLicenza = '$idLic'";
      $rows = $db->query($sql);
      $listaSerie = array();
      while ($r = $rows->fetch())
      {
        $idSerie = $r["Serie_idSerie"];
        $instance->Serie[$idSerie] = Serie::LoadDbData($idSerie);
      }
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

    function iscrivi(){
        global $db;
      }
  }
   
  function findTiratori(&$tiratori, $idLicenze, $nome = "", $cognome = ""){
    global $db;
    $idList = implode(',', $idLicenze);
    if ($idList == ""){
      $idList = "0";
    }
    $sql = "SELECT * FROM `Iscrizioni` 
            WHERE Licenze_idLicenza IN ($idList);";
    dbgTrace($sql);
    $rows = $db->query($sql);
    if ($r = $rows->fetch()){
      $licId = $r['idLicenza'];
      $tiratori[$licId] = Tiratore::LoadDbData($licId);
      return;
    }
  }
 
?>