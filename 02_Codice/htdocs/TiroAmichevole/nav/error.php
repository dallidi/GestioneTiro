<?php 
  require $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/head.php"; 
?>

<body>
<div>
  <?php require "$__ROOT__/intestazione.php" ?>
  <div class="row centro col-12">
    <?php
       $classOption["all"] = "enable";  // all -> entire list
       $classOption["_pageTemplate"] = "selected";
       require "$__ROOT__/navigation.php" 
    ?>
    <div id="pageHtml" class="col-8">
    <!-- ADD YOUR CODE HERE --------------------------------------------------->
      <h1>Errore</h1>
      <p>
      <?php
        $errText = "È avvenuto un errore sconosciuto, riprova...";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_POST["errText"])){
            $errText = $_POST["errText"];
          }
        } else if ($_SERVER["REQUEST_METHOD"] == "GET"){
          if (isset($_GET["errText"])){
            $errText = $_GET["errText"];
          }
        }
        echo $errText;
      ?>
      </p>

    <!-- END OF CUSTOM PAGE CODE ---------------------------------------------->
    </div>
    <?php
       $classOption["all"] = "disabled";  // all -> entire list
       require "$__ROOT__/functions.php" 
    ?>
  </div>
  <div class="pie row col-12">
    <?php require "$__ROOT__/footer.php" ?>
  </div>
</div>
</body>
</html>
