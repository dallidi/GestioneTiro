<?php
  // require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               // '/helpers/requestParameters.php';
 
  function readGetInt($name){
    if (!isset($_GET[$name])){
      throw new Exception("No get value for $name");
    }
    return intval($_GET[$name]);
  }
  
  function readPostInt($name){
    if (!isset($_POST[$name])){
      throw new Exception("No post value for $name");
    }
    return intval($_POST[$name]);
  }
  
  function readPostIntArray($name){
    $result = array();
    if (isset($_POST[$name])){
      foreach($_POST[$name] as $val){
        $result[] = intval($val);
      }
    }
    return $result;
  }
?>