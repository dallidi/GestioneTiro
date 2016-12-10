<?php
  // require_once $_SERVER["DOCUMENT_ROOT"].
               // '/TiroAmichevole/helpers/Debug.php';
  function writeUserError($message){
    error_log("USR;'".$$message);
  }
  
  // $level might be one of the following: INFO, ERROR
  function dbgTrace($message, $level = "INFO"){
    $trace = debug_backtrace()[0];
    error_log("DBG;".$level.";'".$trace["file"]."';".$trace["line"].
              ";'".$message."'");
  }
  
?>