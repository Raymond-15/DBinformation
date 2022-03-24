<?php 
 $dbname = $_POST['table'];
 $db = new PDO("mysql:host=localhost;dbname=$dbname","root","");
 $query = $db->prepare('show tables');
 $query->execute();
 $tabe_in = 'Tables_in_'.$dbname;
 $results = $query->fetch(PDO::FETCH_ASSOC);
 while ($results != null) {
  // change <li> to <option> here **********
  echo '<option>',$results[$tabe_in],'</option>'; 
   $results = $query->fetch(PDO::FETCH_ASSOC);
 }
