<?php require "head.php"; ?>
<body>
<div>
  <?php require "intestazione.php" ?>
  <div class="row centro col-12">
    <?php
       $classOption["all"] = "enable";  // all -> entire list
       $classOption["_pageTemplate"] = "selected";
       require "navigation.php" 
    ?>
    <div id="pageHtml" class="col-8">
    <!-- ADD YOUR CODE HERE --------------------------------------------------->
      <?php 
      ?>

    <!-- END OF CUSTOM PAGE CODE ---------------------------------------------->
    </div>
    <?php
       $classOption["all"] = "disabled";  // all -> entire list
       require "functions.php" 
    ?>
  </div>
  <div class="pie row col-12">
    <?php require "footer.php" ?>
  </div>
</div>
</body>
</html>
