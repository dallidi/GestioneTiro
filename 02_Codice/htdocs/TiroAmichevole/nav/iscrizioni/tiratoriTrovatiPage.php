<?php
  require_once "$__ROOT__/TierData/dataModel/iscritto.php";
  require_once "$__ROOT__/helpers/debug.php";
?>

<?php  
  $licId = ""; $nome = ""; $cognome = "";
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["licenza"])){
      $licId = $_GET["licenza"];
    }
  }
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["licenza"])){
      $licId = intval($_POST["licenza"]);
    }
    if (isset($_POST["nome"])){
      $nome = $_POST["nome"];
    }
    if (isset($_POST["cognome"])){
      $cognome = $_POST["cognome"];
    }
  }
?>
<script>
function sendIdLicenzaTo(idLicenza, url){
  var form = document.createElement("form");
  form.action = url;
  form.method = "POST";
  var input = document.createElement("input");
  input.type = "hidden";
  input.name = "licenza";
  input.value = idLicenza;
  form.appendChild(input); 
  document.body.appendChild(form);  
  form.submit();
}

function iscriviTiratore(idLicenza){
  sendIdLicenzaTo(idLicenza, 
              "<?php echo makeUrl("/nav/iscrizioni/iscriviTiratore.php") ?>");
}
</script>

<table class="leftAlign rowSelection">
  <tr>
    <th>Hidden col</th>
    <th>Licenza</th>
    <th>Cognome</th>
    <th>Nome</th>
    <th>Nascita</th>
    <th>Società</th>
  </tr>
  <?php
    $iscritti = array();
    Iscritto::loadDbData($iscritti, array($licId), $nome, $cognome);
    if (count($iscritti) != 0){
      echo "Da iscritti";
      foreach ($iscritti as &$iscritto){
        $id = $iscritto->id();
        echo '<tr onclick="iscriviTiratore('.$id.')">
                <td>hidden col</td>
                <td>'.$id.'</td>
                <td>'.$iscritto->cognome().'</td>
                <td>'.$iscritto->nome().'</td>
                <td>'.$iscritto->dataNascita().'</td>
                <td><ul>';
                foreach ($iscritto->listaSocieta() as $socKey => $socValue){
                  echo "<li>".$socValue->fullName()."</li>";
                }
                echo '</ul></td>
              </tr>';
      }
    } else {
      echo "Da Licenza";
      $tiratori = array();
      Licenza::loadDbData($tiratori, array($licId), $nome, $cognome);
      foreach ($tiratori as &$tiratore){
        $id = $tiratore->id();
        echo '<tr onclick="iscriviTiratore('.$id.')">
                <td>hidden col</td>
                <td>'.$id.'</td>
                <td>'.$tiratore->cognome().'</td>
                <td>'.$tiratore->nome().'</td>
                <td>'.$tiratore->dataNascita().'</td>
                <td><ul>';
        foreach ($tiratore->listaSocieta() as $socKey => $socValue){
          echo "<li>".$socValue->fullName()."</li>";
        }
         
        echo '</ul></td>
              </tr>';
      }
    }
  ?>
</table>

