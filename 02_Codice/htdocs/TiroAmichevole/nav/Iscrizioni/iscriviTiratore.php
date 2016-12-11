<?php
  require $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/baseUrl.php"; 
  require_once "$__ROOT__/TierData/dataModel/licenza.php";
  require_once "$__ROOT__/helpers/debug.php";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["licenza"])){
      $id = $_POST["licenza"];
    } else {
      internalRedirectTo("/nav/error.php?errTxt=Invalid post!");
      return;
    }
  } else {
    return;
  }
  $tiratori = array();
  $ids = array($id);
  Licenza::loadDbData($tiratori, $ids);
  if (count($tiratori) != 1){
    internalRedirectTo("/nav/error.php?errTxt=Tiratore non univoco!");
    dbgTrace("ERROR", "Tiratore non univoco $id. ".$tiratori);
    return;
  }
  $tiratore = reset($tiratori);
  $tiratore->iscrivi();
  $id = $tiratore->id();
  internalRedirectTo("/nav/iscrizioni/updateIscritto.php?licenza=$id");
?>
