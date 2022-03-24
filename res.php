<?php
$table = $_POST['table'];
$dbname = $_POST['dbase'];
$sql = "SHOW COLUMNS FROM $table";
$db = new PDO("mysql:host=localhost;dbname=$dbname", "root", "");

$table_headers = array();
$results = $db->prepare($sql);
$results->execute();
$res = $results->fetch();

?>
<table>
  <tr>
    <?php
    while ($res != null) {
      echo '<th>', $res['Field'], '</th>';
      $table_headers[] = $res['Field'];
      $res = $results->fetch();
    }

    ?>
  </tr>

  <?php
  $query = $db->prepare("SELECT * FROM $table");
  $query->execute();
  $rs = $query->fetchAll();

  foreach ($rs as  $value) {
    echo '<tr>';
    foreach ($table_headers as $val) {
      echo '<td>', $value[$val], '</td>';
    }
    echo '</tr>';
  }
  ?>