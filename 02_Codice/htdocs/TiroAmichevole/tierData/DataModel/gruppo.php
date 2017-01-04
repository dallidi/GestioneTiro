<?php
  // require_once "$_SERVER["DOCUMENT_ROOT"]/TiroAmichevole".
               // "/TierData/DataModel/gruppo.php";
  require_once 'CategoriaArma.php'
  
  class Gruppo {
    public $Id;
    public $Nome;
    public $CatArma;
    public $Tiratori;
    
    public function __construct(){
    }
    
    public static function Create($Id, $Nome, $CatArma, $Tiratori){
      $instance = new self();
      $instance->Id = $Id;
      $instance->Nome = $Nome;
      $instance->CatArma = $CatArma;
      $instance->Tiratori = $Tiratori;
      return $instance;
    }
    
    public function addTiratore($tiratore){
      if (!isset($this->Tiratori)){
        $this->Tiratori = array();
      }
      if (count($this->Tiratori) >= 5){
        throw new Exception("")
      }
    }
  }
  
  function compFullName($a, $b)
  {
    if ($a->Name() == $b->Name()){
      return 0;
    }elseif ($a->Name() < $b->Name()){
      return -1;
    }
    return 1;
  }
?>