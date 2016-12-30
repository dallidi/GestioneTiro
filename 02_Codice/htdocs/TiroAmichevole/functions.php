
<?php 
  
  if(!isset($classOption)){ $classOption = "";}

//  $classOption["iscrizioni"] = "hidden";
//  $classOption["risultati"] = "hidden";  
//  $classOption["iscrizioni"] = "";
/*
  if (isset($_SESSION['userInfo'])){
    if(checkMinAccess(1)){
      $classOption["classifiche"] = "";
      $classOption["rapporti"] = "";
    }
  }
*/
?>
  <div class="functions col-2">
    <ul class="verticalMenu <?php addOpt($classOption, "all") ?>">
      <li class="<?php addOpt($classOption, 'stampaFS') ?>"><a href="#">Foglio stand</a></li>
      <li class="<?php addOpt($classOption, 'stampaCC') ?>"><a href="#">Carta Corona</a></li>
    </ul>     
  </div>
