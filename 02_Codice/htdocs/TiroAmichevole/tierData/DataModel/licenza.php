<?php 
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // '/TierData/DataModel/licenza.php';
  require_once 'indirizzo.php';
  require_once 'societa.php';
  require_once $_SERVER["DOCUMENT_ROOT"].
               '/TiroAmichevole/TierData/DbInterface/CommonDB.php';
  require_once $_SERVER["DOCUMENT_ROOT"].
               '/TiroAmichevole/helpers/Debug.php';
  
  class Licenza {
    public $Id;
    public $Nome;
    public $Cognome;
    public $DataNascita;
    public $Indirizzo;
    public $ListaSoc;
    
    public function __construct()
    {
    }
    
    public static function create($Id, $Nome, $Cognome, $DataNascita,
                                  $Indirizzo, $ListaSoc)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Nome = $Nome;
      $instance->Cognome = $Cognome;
      $instance->DataNascita = $DataNascita;
      $instance->Indirizzo = $Indirizzo;
      $instance->ListaSoc = $ListaSoc;
      return $instance;
    }
    
    public static function loadDbData(&$instances, $idLicenze,
                                      $nome = "", $cognome = "")
    {
      global $db;
      $ids = array_filter($idLicenze, 'is_int');
      $idList = implode(',', $ids);
      if ($idList == ""){
        $idList = "0";
      }
      $query = "idLicenza IN ($idList)";
      $orderBy = "ORDER BY idLicenza";
      
      if ($nome != ""){
        $query = "$query OR nome LIKE '%$nome%'";
        $orderBy = "ORDER BY nome";
      }
      if ($cognome != ""){
        $query = "$query OR cognome LIKE '%$cognome%'";
        $orderBy = "ORDER BY cognome";
      }
      $where = "";
      if ($query != "")
      {
        $where = "WHERE $query";
      }
      $sql = "SELECT *
              FROM Licenze
              $where";
      $rows = $db->query($sql);
      while ($r = $rows->fetch())
      {
        $idLic = $r["idLicenza"];
        $socList = array();
        $sql = "SELECT idSocieta
                FROM Licenze_has_societa
                JOIN Societa
                ON Licenze_has_societa.Societa_idSocieta = Societa.idSocieta
                WHERE Licenze_has_societa.Licenze_idLicenza = $idLic";
        $societa = $db->query($sql);
        while ($s = $societa->fetch())
        {
          $idList = array();
          $idSoc = $s["idSocieta"];
          $idList[] = $idSoc;
          Societa::loadDbData($socList, $idList);
        }
        $indirizzo = Indirizzo::create($r["via"], $r["viaNo"],
                                       $r["cap"], $r["luogo"]);
        $instances[$idLic] =
          Licenza::create($idLic, $r["nome"], $r["cognome"],
                          sqlToPhpDate($r["dataNascita"], "d.m.Y"),
                          $indirizzo, $socList);
      }
    }

    public static function licenceDbData($idLicenza)
    {
      $tiratori = array();
      $ids = array(intval($idLicenza));
      Licenza::loadDbData($tiratori, $ids);
      if (count($tiratori) != 1){
        dbgTrace("ERROR", "Tiratore non univoco $idLicenza.");
        throw new Exception("Tiratore non univoco $idLicenza.");
      }
      return reset($tiratori);
    }
    
    
    public function iscrivi(){
      global $db;
      $id = $this->Id;
      $sql = "SELECT count(*) AS records, Licenze_idLicenza
              FROM Iscrizioni
              WHERE Licenze_idLicenza = $id";
      $rows = $db->query($sql);
      $count = $rows->fetch()["records"];
      if ($count > 0){
        return;
      }
      $sql = "INSERT INTO Iscrizioni
              (Licenze_idLicenza)
              VALUES
              ($id)";
      $db->query($sql);
    }

    public function id(){
      return $this->Id;
    }
    
    public function nome(){
      return $this->Nome;
    }
    
    public function cognome(){
      return $this->Cognome;
    }
    
    public function dataNascita(){
      return $this->DataNascita;
    }
    
    public function indirizzo(){
      return $this->Indirizzo->Via . " " . $this->Indirizzo->ViaNo;
    }
    
    public function localita(){
      return $this->Indirizzo->Cap . " " . $this->Indirizzo->Luogo;
    }
    
    public function listaSocieta(){
      return $this->ListaSoc;
    }
    
    public function fullName(){
      return $this->Cognome . " " . $this->Nome;
    }
    
    static function compFullName($a, $b)
    {
      if ($a->fullName() == $b->fullName()){
        return 0;
      }elseif ($a->fullName() < $b->fullName()){
        return -1;
      }
      return 1;
    }
    
  }
  
  
?>