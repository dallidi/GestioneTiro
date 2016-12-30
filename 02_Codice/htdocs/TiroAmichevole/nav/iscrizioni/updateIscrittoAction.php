<?php
  require_once "$__ROOT__/TierData/dataModel/iscritto.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               '/helpers/requestParameters.php';
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/categoriaArma.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/categoriaEta.php";
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/societa.php";
  
  dbgTrace("licenza=$id");
  $iscritti = array();
  $idList = array($id);
  Iscritto::loadDbData($iscritti, $idList);
  $count = count($iscritti);
  if ($count != 1){
    internalRedirectTo("/nav/error.php?errTxt=Tiratore non univoco!");
    dbgTrace("Tiratore non univoco $id, count=$count", cDbgError);
    return;
  }
  $iscritto = reset($iscritti);
  $iscritto->aggiorna(readPostInt("categoriaArma"),
                      readPostInt("categoriaEta"),
                      readPostInt("societa"),
                      readPostIntArray("serie"));
?>