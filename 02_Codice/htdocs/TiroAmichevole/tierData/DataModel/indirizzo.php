<?php 
 // require_once "$_SERVER["DOCUMENT_ROOT"]/TiroAmichevole".
              // "/indirizzo.php";
 class Address {
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
    
    public static function Create($Via, $ViaNo, $Cap, $Luogo)
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