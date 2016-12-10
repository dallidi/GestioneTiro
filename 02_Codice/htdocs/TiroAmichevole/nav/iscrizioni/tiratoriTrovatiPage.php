<?php
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
?>
<script>
  function rowClick(idLicenza){
    var url = "<?php echo makeUrl("/nav/iscrizioni/iscriviTiratore.php") ?>" +
      "?licenza=" + idLicenza;
    location = url;
    
  // function(){
      // $.post(url, {licenza: idLicenza, function(data, status){
          // alert("Data: " + data + "\nStatus: " + status);
      // });
  // });     

    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
        // if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("pageHtml").innerHTML = this.responseText;
        // }
    // }
    // xmlhttp.open("GET", "<?php echo makeUrl("/nav/iscrizioni/iscriviTiratore.php") ?>", true);
    // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // xmlhttp.send("licenza="+idLicenza);
  }
 </script>

<table class="leftAlign rowSelection" style="padding-bottom: 0">
  <tr>
    <th>Licenza</th>
    <th>Cognome</th>
    <th>Nome</th>
    <th>Nascita</th>
    <th>Società</th>
  </tr>
  <?php foreach ($nominativi as &$tiratore){
    echo '<tr onclick="rowClick('.$tiratore->id().')">
            <td>'.$tiratore->id().'</td>
            <td>'.$tiratore->cognome().'</td>
            <td>'.$tiratore->nome().'</td>
            <td>'.$tiratore->dataNascita().'</td>
            <td>'.$tiratore->nomeSocieta().'</td>
          </tr>';
  }
  ?>
</table>

