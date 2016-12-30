<?php
  // require_once "$_SERVER["DOCUMENT_ROOT"]/TiroAmichevole".
               // "/gruppo.php";
  require_once 'CategoriaArma.php'
  
  class Gruppo {
    public $Id;
    public $Nome;
    public $CatArma;
    public $Tiratori;
    
    public function gruppoNil()
    {
      $this->Id = 0;
      $this->Nome = "";
      $this->CatArma = new CategoriaArma;
      $this->Tiratori = new array();
    }

    public function __construct()
    {
      $this->gruppoNil();
    }
    
    public static function Create($Id, $Nome)
    {
      $instance = new self();
      $instance->Id = $Id;
      $instance->Nome = $Nome;
      return $instance;
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