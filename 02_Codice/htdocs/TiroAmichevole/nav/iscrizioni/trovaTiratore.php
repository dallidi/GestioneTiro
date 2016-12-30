<?php 
  require $_SERVER['DOCUMENT_ROOT']."/TiroAmichevole/head.php"; 
?>

<body>
<div>
  <?php require "$__ROOT__/intestazione.php" ?>
  <div class="row centro col-12">
    <?php
       $classOption["all"] = "enable";  // all -> entire list
       $classOption["iscrizioni"] = "selected";
       require "$__ROOT__/navigation.php" 
    ?>
    <div id="pageHtml" class="col-8">
    <!-- ADD YOUR CODE HERE ----------------------------------------------------->
      <?php
        require "trovaTiratorePage.php";
      ?>
    <!-- END OF CUSTOM PAGE CODE ------------------------------------------------>
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
