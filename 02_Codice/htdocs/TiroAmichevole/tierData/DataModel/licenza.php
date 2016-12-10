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
    public $Societa;
    
    public function licenzaNil()
    {
      $this->Id = 0;
      $this->Nome = "";
      $this->Cognome = "";
      $this->DataNascita = date("d.m.Y");
      $this->Indirizzo = new Address;
      $this->Societa = array();
    }

    public function __construct()
    {
      $this->licenzaNil();
    }
    
    public static function Create($Id, $Nome, $Cognome, $DataNascita,
                                  $Via, $ViaNo, $Cap, $Luogo, $Societa)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Nome = $Nome;
      $instance->Cognome = $Cognome;
      $instance->DataNascita = $DataNascita;
      $instance->Indirizzo->Via = $Via;
      $instance->Indirizzo->ViaNo = $ViaNo;
      $instance->Indirizzo->Cap = $Cap;
      $instance->Indirizzo->Luogo = $Luogo;
      $instance->Societa = $Societa;
      return $instance;
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
    
    public function nomeSocieta(){
      if (count($this->Societa) > 0){
        return reset($this->Societa)->Nome;
      }
      return "";
    }
    
    public function listaSocieta(){
      return $this->Societa;
    }
    
    public static function LoadDbData($idLic)
    {
      global $db;
      $sql = "SELECT * FROM Licenze_has_Societa AS LicSoc
              WHERE LicSoc.Licenze_idLicenza = '$idLic'";
      $rows = $db->query($sql);
      $listaSocieta = array();
      while ($r = $rows->fetch())
      {
        $idSoc = $r["Societa_idSocieta"];
        $listaSocieta[$idSoc] = Societa::LoadDbData($idSoc);
      }

      $sql = "SELECT * FROM Licenze AS Lic
              WHERE Lic.idLicenza = '$idLic'";
      $rows = $db->query($sql);
      $r = $rows->fetch();
      return Licenza::Create(
                   $r["idLicenza"], $r["Nome"], $r["Cognome"], 
                   sqlToPhpDate($r["DataNascita"], "d.m.Y"), 
                   $r["Via"], $r["ViaNo"], $r["CAP"], $r["Luogo"],
                   $listaSocieta);
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
  
  function findLicenze(&$listaLic, $idLicenze, $nome = "", $cognome = ""){
    global $db;
    $query = "";
    if ($nome != ""){
      $query = " OR nome LIKE '%$nome%'";
    }
    if ($cognome != ""){
      $query = " OR cognome LIKE '%$cognome%'";
    }
    $idList = implode(',', $idLicenze);  
    if ($idList == ""){
      $idList = "0";
    }
    $sql = "SELECT * FROM `Licenze` 
            WHERE idLicenza IN ($idList) $query;";
    dbgTrace  ($sql);
    $rows = $db->query($sql);
    while ($r = $rows->fetch())
    {
      $licId = $r['idLicenza'];
      $listaLic[$licId] = Licenza::LoadDbData($licId);
    }
  }
  
?>