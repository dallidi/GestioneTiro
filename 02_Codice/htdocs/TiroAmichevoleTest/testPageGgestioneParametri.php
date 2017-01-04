<?php
  require_once $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole".
               "/TierData/DataModel/parametro.php";
  require_once "$__ROOT__/helpers/debug.php";
  
  ParInt::Create("noTiratoriGruppo", 5, 0, 100);
  ParInt::Create("testParam1", 1, 1, 100);
  ParInt::Create("testParam2", 2, 1, 100);
  ParInt::Create("testParam3", 3, 1, 100);
  ParInt::Create("testParam4", 4, 1, 100);
  ParInt::Create("testParam5", 5, 1, 100);
  ParInt::Create("testParam6", 6, 1, 100);
  foreach ($params as $par){
    $par->storeValueToDb();
  }
?>
<script type="text/javascript">
function changeValue(parName){
  alert("change " + parName + " value");
}
</script>
<!-- form action="$__ROOT__\TiroAmichevoleTest\testPageGgestioneParametri.php" method="post" -->
  <table id="paramTable" class="leftAlign topAlign" style="padding-bottom: 0">
    <tr>
      <th>Nome</th>
      <th>Default</th>
      <th>Value</th>
      <th>Min</th>
      <th>Max</th>
      <th>Type</th>
    </tr>
    <?php 
      foreach ($params as $parKey => $parVal){
        echo "<tr>
                <td>".$parVal->getName()."</td>
                <td>".$parVal->getDefValue()."</td>
                <td onclick=".'"changeValue('."'$parKey')".'">'.$parVal->getValue()."</td>
                <td>".$parVal->getMinValue()."</td>
                <td>".$parVal->getMaxValue()."</td>
                <td>".$parVal->getParType()."</td>
              </tr>";
      }
    ?>
  </table>
<!-- /form -->
