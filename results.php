
<HTML>
<HEAD>
    <meta charset="utf-8">
    <title>Ваш результат</title>
  <link rel="stylesheet" href="style5.css">

</HEAD>
<BODY>

  <?
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "vkr";



  $db = new mysqli($host, $username, $password, $database);

  echo "<div class='signup-link'><a href='secondpage.php' style='text-decoration: none;'>На выбор темы</a></div>";
  session_start();
  $stud_res=$_SESSION['STUD_RES'];
  session_start();
  $iditheme=$_SESSION['iditheme'];


  $query = "SELECT COUNT_Q, MAX_BALL FROM THEMS WHERE ID_T='".$iditheme."'";
  $result = $db->query($query);
  if ($result)
 {
  $rows = $result->num_rows;

  for ($i = 0; $i < $rows; ++$i) {
  $row = $result->fetch_row();
  $COUNT_Q=$row[0];
  $MAX_BALL=$row[1];
  }

}

  $prom=$MAX_BALL/$COUNT_Q;
  $stud_res=$stud_res*$prom;
  $stud_res=(int)round($stud_res);
  echo "<div class='popup' id='myPopup' aria-hidden='true' onClick='if(event.target == this){closePopup('#myPopup');}'>
  <div class='wrapper' aria-labelledby='popupTitle' aria-describedby='popupText' aria-modal='true'>
   <h2 id='popupTitle'>Ваш результат: ".$stud_res."/".$MAX_BALL." баллов </h2>";
  echo "Данные внесены в Вашу историю результатов";
  session_start();
  $name_s=$_SESSION['NAME_S'];
  echo "<div class ='label'>Вы вошли как: $name_s</div>";
  session_start();
  $get=$_SESSION['IDI'];
  session_start();
  $get_them=$_SESSION['IDI_T'];

  $date = date('Y-m-d H:i:s');
    $qerres="INSERT INTO `RESULTS`(`ID_S`, `ID_T`, `DATE`, `GRADE`,`MAX_BALL`) VALUES ('$get','$get_them','$date','$stud_res','$MAX_BALL')";
    $resultres = $db->query($qerres);


  ?>

</BODY>
