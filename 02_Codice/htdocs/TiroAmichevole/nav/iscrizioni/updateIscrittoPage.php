<?php
  require_once "$__ROOT__/TierData/dataModel/iscritto.php";
  require_once "$__ROOT__/TierData/dataModel/serie.php";
  require_once "$__ROOT__/TierData/dataModel/categoriaArma.php";
  require_once "$__ROOT__/TierData/dataModel/categoriaEta.php";
  require_once "$__ROOT__/helpers/debug.php";
  
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
  // $iscritto->aggiornaDb();
?>
<form action="/TiroAmichevole/nav/iscrizioni/updateIscritto.php" method="post">
  <table class="leftAlign" style="padding-bottom: 0">
    <tr>
      <th>Licenza</th><th>Cognome</th><th>Nome</th><th>Nascita</th><th>Eta</th>
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
      <td><?php echo $iscritto->dataNascita(); ?></td>
      <td><?php echo $iscritto->eta(); ?></td>
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
          if ($multiple){
            echo "<option value='$socId'>$socName</option>";
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
      <th>Serie</th><th>Cat. Arma</th><th>Cat. Età</th> 
    </tr>
    <tr>
      <td>
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
    </tr>
    <tr>
      <th colspan="2" class="center">
        <input type="submit" name="conferma" value="Conferma" />
      </th>
      <td><?php echo $iscritto->LastUpdate ?></td>
    </tr>
  </table>
</form>
