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
  require_once $_SERVER["DOCUMENT_ROOT"].
               '/TiroAmichevole/TierData/DbInterface/CommonDB.php';
  
  class Iscritto {
    public $Id;
    public $Licenza;
    public $CatArma;
    public $CatEta;
    public $Societa;
    public $Serie;
    
    public function __construct()
    {
      
    }
    
    public static function create($Id, $Licenza, $CatArma, $CatEta, $Societa, $Serie)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Licenza = $Licenza;
      $instance->CatArma = $CatArma;
      $instance->CatEta = $CatEta;
      $instance->Societa = $Societa;
      $instance->Serie = $Serie;
      return $instance;
    }

    public static function loadDbData(&$instances, $idIscritti,
                                      $nome = "", $cognome = "")
    {
      global $db;
      $idList = implode(',', $idIscritti);
      if ($idList == ""){
        $idList = "0";
      }
      $query = "Licenze_idLicenza IN ($idList)";    
      $sql = "SELECT * FROM `Iscrizioni` 
              WHERE $query";
      dbgTrace($sql);
      $rows = $db->query($sql);
      while ($r = $rows->fetch()){
        $idLic = $r["Licenze_idLicenza"];



  // $tiratori = array();
  // $ids = array($id);
  // Licenza::loadDbData($tiratori, $ids);
  // if (count($tiratori) != 1){
    // internalRedirectTo("/nav/error.php?errTxt=Tiratore non univoco!");
    // dbgTrace("ERROR", "Tiratore non univoco $id. ".$tiratori);
    // return;
  // }
  // $tiratore = reset($tiratori);

        $instances[$idLic] = 
          Iscritto::create($idLic, 
                   Licenza::licenceDbData($idLic),
                   CategoriaArma::loadDbData($r["CategoriaArmi_idCategoria"]),  
                   CategoriaEta::loadDbData($r["CategoriaEta_idCategoriaEta"]),
                   Societa::societaDbData($r["Societa_idSocieta"]),
                   NULL);
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
?>