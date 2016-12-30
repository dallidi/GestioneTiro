<?php
  require $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/baseUrl.php"; 
  require_once "$__ROOT__/TierData/dataModel/licenza.php";
  require_once "$__ROOT__/helpers/debug.php";
  
  $id = 0;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    dbgTrace("method post");
    if (isset($_POST["licenza"])){
      $id = intval($_POST["licenza"]);
      dbgTrace("licence set to $id");
    } else {
      internalRedirectTo("/nav/error.php?errTxt=Invalid post!");
      return;
    }
  } else {
    return;
  }
  $tiratori = array();
  $idList = array($id);
  dbgTrace("loading licence");
  Licenza::loadDbData($tiratori, $idList);
  if (count($tiratori) != 1){
    internalRedirectTo("/nav/error.php?errTxt=Tiratore non univoco!");
    dbgTrace("ERROR", "Tiratore non univoco $id. ");
    return;
  }
  $tiratore = reset($tiratori);
  $tiratore->iscrivi();
  $id = $tiratore->id();
  dbgTrace("redirecting to updateIscritto licenza=$id");
  internalRedirectTo("/nav/iscrizioni/updateIscritto.php?licenza=$id");
?>
