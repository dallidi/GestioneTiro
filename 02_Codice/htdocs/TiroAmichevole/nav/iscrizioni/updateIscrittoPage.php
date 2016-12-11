<?php
  require_once "$__ROOT__/TierData/dataModel/iscritto.php";
  require_once "$__ROOT__/helpers/debug.php";
  
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["licenza"])){
      $id = $_GET["licenza"];
    } else {
      internalRedirectTo("/nav/error.php?errTxt=Invalid get!");
      return;
    }
  } else {
    return;
  }
  $tiratori = array();
  $ids = array($id);
  Iscritto::loadDbData($tiratori, $ids);
  if (count($tiratori) != 1){
    internalRedirectTo("/nav/error.php?errTxt=Tiratore non univoco!");
    dbgTrace("ERROR", "Tiratore non univoco $id. ".$tiratori);
    return;
  }
  $tiratore = reset($tiratori);
  echo $tiratore->fullName();
  // $tiratore->aggiorna();
?>
