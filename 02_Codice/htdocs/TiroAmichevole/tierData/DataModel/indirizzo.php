<?php 
 // require_once "$_SERVER["DOCUMENT_ROOT"]/TiroAmichevole".
              // "/TierData/DataModel/indirizzo.php";
 class Indirizzo {
    public $Via;
    public $ViaNo;
    public $Cap;
    public $Luogo;
    
    public function __construct()
    {
      $this->Via = "";
      $this->ViaNo = "";
      $this->Cap = "";
      $this->Luogo ="";
    }
    
    public static function create($Via, $ViaNo, $Cap, $Luogo)
    {
      $instance = new self();
      $instance->Via = $Via;
      $instance->ViaNo = $ViaNo;
      $instance->Cap = $Cap;
      $instance->Luogo = $Luogo;
      return $instance;
    }
  }
?>