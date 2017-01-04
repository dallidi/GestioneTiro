<?php
  require_once "$__ROOT__/TierData/dataModel/parametro.php";
  require_once "$__ROOT__/helpers/debug.php";
  
  function createParam($nome, $minVal, $maxVal, $defVal = null){
    ParInt::Create($nome);
    $params[$nome]->setMinValue(1);
    $params[$nome]->setMaxValue(100);
    if ($defVal != null){
      $params[$nome]->setValue(5);
    }
  }
  createParam("noTiratoriGruppo", 1, 100);
  createParam("testParam1", 1, 100, );
  createParam("testParam2", 1, 100, );
  createParam("testParam3", 1, 100, );
  createParam("testParam4", 1, 100, );
  createParam("testParam5", 1, 100, );
  createParam("testParam6", 1, 100, );
?>
<form action="/TiroAmichevole/nav/iscrizioni/updateIscritto.php" method="post">
  <table class="leftAlign topAlign" style="padding-bottom: 0">
    <tr>
      <th>Licenza</th><th>Cognome</th><th>Nome</th><th>Nascita</th>
    </tr>
    <tr>
      <td>
        <input type="text" name="licenza" 
               value="<?php echo $iscritto->id(); ?>" readonly>
      </td>
      <td>
        <input type="text" name="cognome" 
               value="<?php echo $iscritto->cognome(); ?>" readonly>
      </td>
      <td>
        <input type="text" name="nome" 
               value="<?php echo $iscritto->nome(); ?>" readonly>
      </td>
      <td>
        <input type="text" name="nascita" 
               value="<?php echo $iscritto->dataNascita(); ?>" readonly>
      </td>
    </tr>
    <tr>
      <th>Società</th>
      <td>
        <?php
          $socList = $iscritto->listaSocieta();
          $multiple = count($socList) > 1;
          if ($multiple){
            echo "<select name='societa'>";
          }
          foreach($socList as $soc){
            $socId = $soc->Id;
            $socName = $soc->Nome;
            $selected = "";
            if (isset($iscritto->Societa) && $iscritto->Societa->Id == $socId){
              $selected = "selected";
            }
            if ($multiple){
              echo "<option value='$socId' $selected>$socName</option>";
            } else {
              echo "<input type='hidden' name='societa' value='$socId'>$socName";
            }
          }
          if ($multiple){
            echo "</select>";
          }
        ?>        
      </td>
    </tr>
    <tr>
      <th>Serie</th><th>Cat. Arma</th><th>Cat. Età</th><th>Eta</th> 
    </tr>
    <tr>
      <td rowspan="3">
        <?php
          $series = array();
          allSerie($series);
          $checked = "";
          foreach ($series as $serie){
            $id = $serie->Id;
            $descr = $serie->Descrizione;
            if ($iscritto->hasSerie($id)){
              $checked = "checked";
            } else {
              $checked = "";
            }
            echo "<input type='checkbox' name='serie[]' 
                         value='$id' $checked/>$descr<br/>";
          }
        ?>
      </td>
      <td>
        <?php
          $catArmi = array();
          allCatArma($catArmi);
          echo "<select name='categoriaArma'>";
          foreach($catArmi as $catArma){
            $catArmaId = $catArma->Id;
            $txt = $catArma->CodiceCat . " (". $catArma->Descrizione . ")";
            $selected = "";
            if ($catArmaId == $iscritto->CatArma->Id){
              $selected = "selected";
            }
            echo "<option value='$catArmaId' $selected>$txt</option>";
          }
          echo "</select>";
        ?>
      </td>
      <td>
        <?php
          $allCatEta = array();
          allCatEta($allCatEta);
          echo "<select name='categoriaEta'>";
          foreach($allCatEta as $catEta){
            if (!$catEta->isAgeOk($iscritto->dataNascita())){
              continue;
            }
            $catEtaId = $catEta->Id;
            $txt = $catEta->CodiceEta . " (". $catEta->Descrizione . ")";
            $selected = "";
            if ($catEtaId == $iscritto->CatEta->Id){
              $selected = "selected";
            }
            echo "<option value='$catEtaId' $selected>$txt</option>";
          }
          echo "</select>";
        ?>
      </td>
      <td><?php echo $iscritto->eta(); ?></td>
    </tr>
    <tr>
      <th>Gruppo</th><th></th>
    </tr>
    <tr>
      <td><?php echo "Nome gruppo" ?></td>
      <td><input type="submit" name="nuovoGruppo" value="Nuovo" /></td>
    </tr>
    <tr>
      <th colspan="2" class="center">
        <input type="submit" name="conferma" value="Conferma" />
      </th>
      <td><?php echo $iscritto->LastUpdate ?></td>
    </tr>
  </table>
</form>
