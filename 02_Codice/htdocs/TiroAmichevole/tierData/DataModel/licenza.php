<?php 
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // '/TierData/DataModel/licenza.php';
  require_once 'indirizzo.php';
  require_once 'societa.php';
  require_once $_SERVER["DOCUMENT_ROOT"].
               '/TiroAmichevole/TierData/DbInterface/CommonDB.php';
  
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
  
  function findLicenze(&$listaLic, $idLicenza, $query){
    global $db;
    $query = '%' . $query . '%';
    $sql = "SELECT * FROM `Licenze` 
            WHERE idLicenza = '" . $idLicenza . "' OR 
                  cognome LIKE '" . $query . "' OR 
                  nome LIKE '" . $query . "'";
    $rows = $db->query($sql);
    while ($r = $rows->fetch())
    {
      $licId = $r['idLicenza'];
      $listaLic[$licId] = Licenza::LoadDbData($licId);
    }
  }
  
?>