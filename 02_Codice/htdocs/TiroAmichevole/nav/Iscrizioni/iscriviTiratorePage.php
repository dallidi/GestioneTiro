<?php
  require_once "$__ROOT__/TierData/DbInterface/CommonDB.php";
  require_once "$__ROOT__/TierData/dataModel/tiratore.php";
  require_once "$__ROOT__/helpers/debug.php";
  
  
  $tiratori = array();
  $licenze = array();
  $licId = ""; $nome = ""; $cognome = "";
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["licenza"])){
      $licId = $_GET["licenza"];
    }
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["licenza"])){
      $licId = $_POST["licenza"];
    }
    if (isset($_POST["nome"])){
      $nome = $_POST["nome"];
    }
    if (isset($_POST["cognome"])){
      $cognome = $_POST["cognome"];
    }
  }
  findTiratori($tiratori, array($licId), $nome, $cognome);
  $noTiratori = count($tiratori);
  if ($noTiratori == 0){
    findLicenze($licenze, array($licId), $nome, $cognome);
    $nominativi = $licenze;
  } else {
    $nominativi = $tiratori;
  }
  if (count($nominativi) > 0){
    $tiratore = array_values($nominativi)[0];
  } else {
    $tiratore = new Tiratore();
  }
  // $jsonNominativi = json_encode($nominativi);
  // dbgTrace($jsonNominativi);
  $allCatArma = array();
  allCatArma($allCatArma);
  $allCatEta = array();
  allCatEta($allCatEta);
?>

<script type="text/javascript">
  var nominativi = JSON.parse('<?php echo json_encode($Nominativi) ?>');
  var len = Object.keys(nominativi).length;
  var iter = 0;
  var catArmi = JOSN.parse('<?php json_encode($allCatArma) ?>');
  var catEta = JOSN.parse('<?php json_encode($allCatEta) ?>');
  console.log(nominativi);
  console.log(catArmi);
  console.log(catEta);
  function display()
  {
    var obj = Object.values(nominativi)[iter];
    document.getElementById('licenza').setAttribute("value", obj.Id);
    document.getElementById('nome').setAttribute("value", obj.Nome);
    document.getElementById('cognome').setAttribute("value", obj.Cognome);
    document.getElementById('dataNascita').setAttribute("value", obj.DataNascita);
    document.getElementById('indirizzo').innerHTML = buildIndirizzo(obj);
    document.getElementById('societa').innerHTML = buildListaSocieta(obj.Societa);
    document.getElementById('catArma').innerHTML = buildCatArmi(obj.CatArma);
    document.getElementById('catEta').innerHTML = buildCatEta(obj.CatEta);
  }
  
  function buildIndirizzo(obj){
    return obj.Indirizzo.Via + " " + obj.Indirizzo.ViaNo + " / " +
           obj.Indirizzo.Cap + " " + obj.Indirizzo.Luogo
  }
  
  function buildListaSocieta(obj){
    var selected = "selected";
    var result = ""; 
    for (i = 0; i < Object.keys(obj).length; i++){
      var soc = Object.values(obj)[i];
      result = result + '<option value="' + soc.Id + '" ' + selected + '>' +
               soc.Nome + '</option>';
      selected = "";
    }
    return result;
  }
  
  function buildCatArmi(obj){
    var result = ""; 
    for (i = 0; i < Object.keys(catArmi).length; i++){
      var catArma = Object.values(catArmi)[i];
      result = result + '<option value="' + catArma.Id + '" ';
      if (catArma.Id == obj.id){
        result += "selected";
      }        
      result += '>' + catArma.Descrizione + '</option>';
    }
    return result;
  }
  
  function buildCatEta(obj){
    var result = ""; 
    for (i = 0; i < Object.keys(catEta).length; i++){
      var cat = Object.values(catEta)[i];
      result = result + '<option value="' + cat.Id + '" ';
      if (cat.Id == obj.id){
        result += "selected";
      }        
      result += '>' + cat.Descrizione + '</option>';
    }
    return result;
  }
  
  function next(){
    iter++;
    if (iter >= len){
      iter = 0;
    }
    display();
  }
  function previous(){
    // initVar();
    iter--;
    if (iter <= 0){
      iter = len - 1;
    }
    display();
  }

</script>

<form action="/TiroAmichevole/nav/iscrizioni/iscriviTiratore.php" method="post">
  <table class="leftAlign" style="padding-bottom: 0">
    <tr>
      <th>Licenza / Nascita</th>
      <td>
        <input id="licenza" type="text" name="licenza" 
               value="<?php echo $tiratore->id(); ?>" />
      </td>
      <td>
        <input id="dataNascita" type="text"  name="dataNascita" 
               value="<?php echo $tiratore->dataNascita(); ?>" />
      </td>
    </tr>
    <tr>
      <th>Cognome / Nome</th>
      <td>
        <input id="cognome" type="text"  name="cognome" 
               value="<?php echo $tiratore->cognome(); ?>" />
      </td>
      <td>
        <input id="nome" type="text"  name="nome" 
               value="<?php echo $tiratore->nome(); ?>" />
      </td>
    </tr>
    <tr>
      <th>Via / Luogo</th>
      <td id="indirizzo" colspan="2">
        <?php echo $tiratore->indirizzo(); ?> /
        <?php echo $tiratore->localita(); ?>
      </td>
    </tr>
    <tr>
      <th>Società / Cat.</th>
      <td>
        <select id="societa" name="societa">
          <?php
            $lista = $tiratore->listaSocieta();
            $selected = "selected";
            foreach($lista as &$soc){
              echo '<option value="'.$soc->Id.'" '.$selected.'>'.
                   $soc->Nome.'</option>';
              $selected = "";
            }
          ?>
        </select>
      </td>
      <td>
        <select id="catArma" name="catArma">
          <option value="<?php echo $tiratore->indirizzo(); ?>">
            <?php echo $tiratore->catArma(); ?> 
          </option>
        </select>
        /
        <?php echo $tiratore->localita(); ?>
      </td>
    </tr>
    <tr>
      <th><input type="submit" name="trova" value="Trova" /></th>
      <td>
        <input type="button" onClick="previous();" value="Precendente"/>
      </td>
      <td>
        <input type="button" onClick="next();" value="Successivo"/>
      </td>
      <th>
        <input type="submit" name="iscrivi" value="Iscrivi"/>
      </th>
    </tr>
  </table>
</form>

