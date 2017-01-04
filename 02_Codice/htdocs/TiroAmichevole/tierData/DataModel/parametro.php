<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // "/TierData/DataModel/parametro.php";
  require_once $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/baseUrl.php"; 
  require_once "$__ROOT__/TierData/DbInterface/CommonDB.php";
  require_once "$__ROOT__/helpers/Debug.php";
  
  $params = array();
  
  class RawParData{
    public $Id;
    public $Type;
    public $Val;
    public $DefVal;
    public $MinVal;
    public $MaxVal;
    
    public static function Create($Id, $Type, $Val, $DefVal, $MinVal, $MaxVal){
      $instance = new self();
      $instance->Id = $Id;
      $instance->Type = $Type;
      $instance->Val = $Val;
      $instance->DefVal = $DefVal;
      $instance->MinVal = $MinVal;
      $instance->MaxVal = $MaxVal;
      
      return $instance;
    }
  }
  
  abstract class Parametro {
    private $id;
    private $nome;
    
    abstract protected function getParType();
    abstract protected function getParTypeId();
    abstract public function getValue();
    abstract public function getMinValue();
    abstract public function getMaxValue();
    abstract public function setValue($aValue);
    abstract public function setMinValue($aValue);
    abstract public function setMaxValue($aValue);
    abstract protected function readValueFromDb();
    
    public function __construct(){
    }

    public function __destruct() {
      global $params;
      unset($params[$this->nome]);
    }    

    public function getName(){
      return $this->nome;
    }
    
    protected function readDbData($nome){
      global $db;
      dbgTrace("reading db data for $nome");

      $this->id = 0;
      $this->nome = $nome;

      $sql = "SELECT idConfig, name, COUNT(idConfig) AS noOfRecords
              FROM Config
              WHERE name='".$this->nome."'";
      dbgTrace($sql);
      $rows = $db->query($sql);
      if ($r = $rows->fetch()){
        switch(intval($r["noOfRecords"])){
          case 0: 
            break;
          case 1:
            $this->id = intval($r["idConfig"]);
            $this->readValueFromDb();
            break;
          default:
            dbgTrace("Parameter name not unique, name=".$this->nome, cDbgError);
            throw new Exception("Parameter name not unique, name=".$this->nome);
            break;
        }
      }
    }
    
    public static function compFullName($a, $b)
    {
      if ($a->getName() == $b->getName()){
        return 0;
      }elseif ($a->getName() < $b->getName()){
        return -1;
      }
      return 1;
    }
    
    protected function readRawDbData(){
      global $db;
      $sql = "SELECT *
              FROM Config
              WHERE idConfig=".$this->id;
      $rows = $db->query($sql);
      if (!($r = $rows->fetch())){
        dbgTrace("Unknown parameter, name=".$this->nome.
                 " idConfig=".$this->id, cDbgError);
        throw new Exception("Unknown parameter, name=".$this->nome.
                            ", idConfig=".$this->id);
      }
      return RawParData::Create($r["idConfig"], 
                                $r["ParType_idParType"],
                                $r["value"],
                                $r["defVal"],
                                $r["minVal"],
                                $r["maxVal"]);
    }
    protected function writeDbData(){
      global $db;
      $sql = "UPDATE Config
              SET value=".$this->getValue().", 
                  defVal=".$this->getDefValue().", 
                  minVal=".$this->getMinValue().", 
                  maxVal=".$this->getMaxValue()."
              WHERE idConfig=".$this->id;
      if ($this->id == 0){
        $sql = "INSERT INTO Config 
                (name, ParType_idParType, value, defVal, minVal, maxVal)
                VALUES ('".
                   $this->nome."',". 
                   $this->getParTypeId().",". 
                   $this->getValue().",". 
                   $this->getDefValue().",". 
                   $this->getMinValue().",". 
                   $this->getMaxValue().")";
      }
      dbgTrace($sql);
      $db->query($sql);
      $this->writeDbParType();
    }
    private function writeDbParType(){
      global $db;
      $sql = "SELECT idParType
              FROM ParType
              WHERE idParType=".$this->getParTypeId();
      $rows = $db->query($sql);
      $sql = "INSERT INTO ParType
              (idParType, type)
              VALUES (".
                $this->getParTypeId().",'".
                $this->getParType()."')";
      if($r = $rows->fetch()){
        $sql = "UPDATE ParType
                SET type='".$this->getParType()."'
                WHERE idParType=".$this->getParTypeId();
      }
      $db->query($sql);
    }
  }
  
  class ParInt extends Parametro{
    
    private $val;
    private $defVal;
    private $minVal;
    private $maxVal;
  
    public function getParType(){
      return "INT";
    }
    public function getParTypeId(){
      return 1;
    }

    public static function Create($nome, $defVal, $minVal, $maxVal){
      global $params;
      dbgTrace("creating parameter $nome");
      if (!isset($params[$nome])){
        $par = new self();
        $par->nome = $nome;
        $par->defVal = $defVal;
        $par->val = $defVal;
        $par->minVal = $minVal;
        $par->maxVal = $maxVal;
        $par->readDbData($nome);
        $params[$nome] = $par;
      }
      return $params[$nome];
    }
  
    public function getValue(){
      return $this->val;
    }
    public function getDefValue(){
      return $this->defVal;
    }
    public function getMinValue(){
      return $this->minVal;
    }
    public function getMaxValue(){
      return $this->maxVal;
    }
    
    public function setValue($aValue){
      $this->val = $aValue;
      $this->storeValueToDb();
    }
    public function setDefValue($aValue){
      $this->defVal = $aValue;
      $this->storeValueToDb();
    }
    public function setMinValue($aValue){
      $this->minVal = $aValue;
      $this->storeValueToDb();
    }
    public function setMaxValue($aValue){
      $this->maxVal = $aValue;
      $this->storeValueToDb();
    }

    private function checkParType(&$rd){
      if ($rd->Type != $this->getParTypeId()){
        dbgTrace("Wrong parameter type, parType=".$rd->Type . 
                 " expected=".$this->getParTypeId(), cDbgError);
        throw new Exception("Wrong parameter type, parType=".$rd->Type . 
                            " expected=".$this->getParTypeId());
      }
    }
    
    protected function readValueFromDb(){
      $rd = $this->readRawDbData();
      $this->checkParType($rd);
      $this->id = $rd->Id;
      $this->val = intval($rd->Val); 
      $this->defVal = intval($rd->DefVal); 
      $this->minVal = intval($rd->MinVal); 
      $this->maxVal = intval($rd->MaxVal); 
      if ($this->minVal > $this->maxVal){
        throw new Exception("min > max, ".
                            "(min=".$this->minVal.
                            " max=".$this->maxVal.")");
      }
      if ($this->val < $this->minVal){
        throw new Exception("Value < Min, ".
                            "(Value=".$this->val.
                            " min=".$this->minVal.")");
      }
      if ($this->val > $this->maxVal){
        throw new Exception("Value > Max, reset to Max ".
                            "(Value=".$this->val.
                            " max=".$this->maxVal.")");
      }
    }

    public function storeValueToDb(){
      $this->writeDbData();
    }
    
  }
  
?>