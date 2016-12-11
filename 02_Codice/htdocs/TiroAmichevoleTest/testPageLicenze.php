<?php 
  require $_SERVER["DOCUMENT_ROOT"]."/TiroAmichevole/head.php"; 
  require_once "$__ROOT__/TierData/DataModel/licenza.php";

  function arrayToHtmlTable($anArray)
  {
    echo "<table>
          <thead>
            <tr><th>Key</th>
              <th>Nome</th>
              <th>Cognome</th>
              <th>Nascita</th>
              <th>Indirizzo</th>
              <th>Società</th>
            </tr>
          </thead>
          <tbody>";
    foreach ($anArray as $key => $value) {
      $socHtml = "<ul>";
      foreach ($value->listaSocieta() as $socKey => $socValue){
        $socHtml = "$socHtml <li>".$socValue->fullName()."</li>";
      }
      $socHtml = "$socHtml </ul>";
      
      echo "<tr>
              <td>$key</td>
              <td>".$value->nome()."</td>
              <td>".$value->cognome()."</td>
              <td>".$value->dataNascita()."</td>
              <td>".$value->indirizzo()."<br>".$value->localita()."</td>
              <td>$socHtml</td>
            </tr>";
    }
    echo "</tbody>
          </table>";    
  }

?>
<body>
<div>
  <?php require "$__ROOT__/intestazione.php" ?>
  <div class="row centro col-12">
    <?php
       $classOption["all"] = "enable";  // all -> entire list
       $classOption["testPage"] = "selected";
       require "$__ROOT__/navigation.php" 
    ?>
    <div id="pageHtml" class="col-8">
    <!-- ADD YOUR CODE HERE ----------------------------------------------------->
      <?php 
        $listaLicenze = array();
        $idLicenze = array(999950,999951,999952,999953,999954,999955,999956,
                           999990);
        Licenza::loadDbData($listaLicenze, $idLicenze);
        arrayToHtmlTable($listaLicenze);
      ?>
    <!-- END OF CUSTOM PAGE CODE ------------------------------------------------>
    </div>
     <?php
       $classOption["all"] = "disabled";  // all -> entire list
       require "$__ROOT__/functions.php" 
    ?>
 </div>
  <div class="row pie col-12">
    <?php require "$__ROOT__/footer.php" ?>
  </div>
</div>
</body>
</html>
