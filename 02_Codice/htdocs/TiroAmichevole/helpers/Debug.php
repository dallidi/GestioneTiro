<?php
  // require_once $_SERVER["DOCUMENT_ROOT"].
               // '/TiroAmichevole/helpers/Debug.php';
  define("cDbgError", "ERROR");
  define("cDbgToDo", "TODO");
  define("cDbgInfo", "INFO");  

  function writeUserError($message){
    error_log("USR;'".$$message);
  }
  
  // $level might be one of the following: INFO, ERROR
  function dbgTrace($message, $level = cDbgInfo){
    $trace = debug_backtrace()[0];
    error_log("DBG;".$level.";'".$trace["file"]."';".$trace["line"].
              ";'".$message."'");
  }
  
?>