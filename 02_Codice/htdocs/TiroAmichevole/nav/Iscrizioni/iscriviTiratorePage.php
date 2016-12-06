<?php
  require_once "$__ROOT__/TierData/DbInterface/CommonDB.php";
  require_once "$__ROOT__/TierData/dataModel/tiratore.php";
  
  $tiratore = new Tiratore();
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["ID"])){
      $id = $_GET["ID"];
      getDocenteById($db, $id, $doc);
    }
  }
?>

<form action="iscriviTiratore.php" method="post">
  <table class="leftAlign" style="padding-bottom: 0">
    <tr>
      <th>Lic</th><td><?php echo ; ?></td>
    </tr>
    <tr>
      <td><input type="text" name="cid" value="<?php echo $doc->Cid ?>" size="8"></td>
      <td><input type="text" name="sigla" value="<?php echo $doc->Sigla ?>" size="8"></td>
      <td><input type="text" name="nome" value="<?php echo $doc->Nome ?>" size="29"></td>
      <td><input type="text" name="cognome" value="<?php echo $doc->Cognome ?>" size="30"></td>
    </tr>
  </table>
</form>
