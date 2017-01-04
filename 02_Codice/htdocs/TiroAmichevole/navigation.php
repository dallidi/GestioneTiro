
<?php 
  function addOpt($opt, $item){
    if (isset($opt[$item])){
      echo $opt[$item];
    }
  }
  
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
  <div class="navigation col-2">
    <ul class="verticalMenu <?php addOpt($classOption, "all") ?>">
      <li class="<?php addOpt($classOption, 'iscrizioni') ?>">
        <a href="/TiroAmichevole/nav/iscrizioni/trovaTiratore.php">
          Iscrizioni
        </a>
      </li>
      <li class="<?php addOpt($classOption, 'risultati') ?>">
        <a href="#">Risultati</a>
      </li>
      <li class="<?php addOpt($classOption, 'classifiche') ?>">
        <a href="#">Classifiche</a>
      </li>
      <li class="<?php addOpt($classOption, 'rapporti') ?>">
        <a href="#">Rapporti</a>
      </li>
      <li class="<?php addOpt($classOption, 'rapporti') ?>">
        <a href="/TiroAmichevole/nav/parametri/gestioneParametri.php">
          Parametri
        </a>
      </li>
    </ul>     
  </div>
