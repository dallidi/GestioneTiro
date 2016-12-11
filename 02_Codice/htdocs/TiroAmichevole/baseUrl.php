<?php
  // require $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/baseUrl.php"; 
  $__ROOT__ = $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole";
  function internalRedirectTo($path){
    header("Location: ".makeUrl($path));
  }
  function makeUrl($path){
    return "/TiroAmichevole$path";
  }
?>