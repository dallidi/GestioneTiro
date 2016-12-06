<?php 
  // require_once $_SERVER["DOCUMENT_ROOT"].
               // '/TiroAmichevole/TierData/DbInterface/CommonDB.php';
  
  $db = connectDB();
  
  function connectDB(){
    $servername = "localhost";
    $username = "";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=TiroAmichevole", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
 }
  
  function disconnectDB($db){
    $db = null;
  }
  
  function sqlToPhpDate($sqlDate, $format){
    return date($format, strtotime($sqlDate));
  }
  
  function phpDateToSql($date){
    return date_format($date, "Y-m-d");
  }
 
  function convertDateFormat($dateStr, $fromFormat, $toFormat){
    return date_format(date_create_from_format($fromFormat, $dateStr), $toFormat);
  }
?>
