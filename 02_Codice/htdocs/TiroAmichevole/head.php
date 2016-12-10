<?php
  // require $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/head.php"; 
  $__ROOT__ = $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole";
  function internalRedirectTo($path){
    header("Location: ".internaleRedirectToUrl($path));
  }
  function makeUrl($path){
    return "/TiroAmichevole/$path";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Tiro Amichevole</title>
<meta charset="utf-16">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/TiroAmichevole/style/gestioneTiro.css">
<script>
</script>
</head>
