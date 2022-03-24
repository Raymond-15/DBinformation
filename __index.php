<?php
$db = new PDO('mysql:host=localhost;dbname=mysql', 'root', '');
$dbs = $db->query('SHOW DATABASES');
?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <style type="text/css">
    li:hover {
      cursor: pointer;
    }

    #list {
      float: left;
      width: 30%;
    }

    #table {
      float: right;
      width: 68%;
    }

    #main {
      width: 70%;
      margin: 0 auto;
    }

    table,
    th,
    td {
      border: 1px solid #000;
    }

    th {
      width: 120px;
      background-color: #000;
      color: #fff;
      text-transform: capitalize;
    }

    table {
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <div id="main">
    <div id="list">
      <select id="dbase" onchange="getTables(this.value)">
        <option>Select databse</option>
        <?php
        while (($db = $dbs->fetchColumn(0)) !== false) {
          echo '<option>', $db, '</option>';
        }
        ?>
      </select>
      <!-- displaying dropdown ************* -->
      <option id="bulk" onchange="drop(this.value)"></option>
    </div>
    <div id="table"></div>
  </div>
  <script type="text/javascript">
    //*************update for displaying dropdown menu *******
    function drop(table) {

      var table = table;
      var db = dbase.value;
      var data = new XMLHttpRequest();
      data.open("POST", "list.php");

      data.onreadystatechange = function() {
        if (data.readyState === 4 && data.status === 200) {
          document.getElementById('table').innerHTML = data.responseText;

        }
      }
      data.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      data.send('table=' + table + '&dbase=' + db);
    }
    //***********end of update **********
    function getTables(table) {
      var data = new XMLHttpRequest();
      data.open("POST", "get_tables.php");

      data.onreadystatechange = function() {
        if (data.readyState === 4 && data.status === 200) {
          document.getElementById('bulk').innerHTML = data.responseText;

        }
      }
      data.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      data.send('table=' + table);
    }
  </script>
</body>

</html>