<?php
  require_once "$__ROOT__/TierData/DbInterface/CommonDB.php";
  require_once "$__ROOT__/TierData/dataModel/iscritto.php";
  require_once "$__ROOT__/helpers/debug.php";
?>

<form action="/TiroAmichevole/nav/iscrizioni/tiratoriTrovati.php" method="post">
  <table class="leftAlign" style="padding-bottom: 0">
    <tr>
      <th>Licenza</th><th>Cognome</th><th>Nome</th> 
    </tr>
    <tr>
      <td>
        <input id="licenza" type="text" name="licenza" 
               value="" />
      </td>
      <td>
        <input id="cognome" type="text"  name="cognome" 
               value="" />
      </td>
      <td>
        <input id="nome" type="text"  name="nome" 
               value="" />
      </td>
    </tr>
    <tr>
      <th colspan="3" class="center">
        <input type="submit" name="trova" value="Trova" />
      </th>
    </tr>
  </table>
</form>

