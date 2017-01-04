<?php
  require $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/baseUrl.php"; 
  require_once "$__ROOT__/TierData/dataModel/licenza.php";
  require_once "$__ROOT__/helpers/debug.php";
  
  $id = 0;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["licenza"])){
      $id = intval($_POST["licenza"]);
    } else {
      internalRedirectTo("/nav/error.php?errTxt=Invalid post!");
      return;
    }
  } else {
    return;
  }
  $tiratori = array();
  $idList = array($id);
  Licenza::loadDbData($tiratori, $idList);
  if (count($tiratori) != 1){
    dbgTrace("ERROR", "Tiratore non univoco $id.");
    internalRedirectTo("/nav/error.php?errTxt=Tiratore non univoco!");
    return;
  }
  $tiratore = reset($tiratori);
  $tiratore->iscrivi();
  $id = $tiratore->id();
  internalRedirectTo("/nav/iscrizioni/updateIscritto.php?licenza=$id");
?>
