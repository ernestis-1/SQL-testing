<!DOCTYPE HTML>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <title>История результатов</title>
  <link rel="stylesheet" href="style3.css">

</HEAD>
<BODY>
  <?php
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "vkr";

  session_start();
  $get=$_SESSION['IDI'];
  session_start();
  $name_s=$_SESSION['NAME_S'];

  echo "<div class ='label'><td>Вы вошли как: $name_s </td></div>";

  $db = new mysqli($host, $username, $password, $database);

  $query = "SELECT THEMS.NAME, RESULTS.DATE, RESULTS.GRADE, RESULTS.MAX_BALL FROM RESULTS JOIN THEMS ON RESULTS.ID_T=THEMS.ID_T WHERE ID_S='".$get."' ORDER BY RESULTS.GRADE";
  //echo "<div class ='text'><td>| Номер темы | Дата | Оценка | Максимальный балл |</td></div>";

  $result = $db->query($query);
  if ($result) {


  $rows = $result->num_rows;
  $field = $result->field_count;

echo " <table>
	<thead>
		<tr>
			<th>Название темы</th>
			<th>Дата</th>
			<th>Оценка</th>
			<th>Максимальный балл</th>
		</tr>
	</thead>";


      for ($i = 0; $i < $rows; ++$i) {
      $row = $result->fetch_row();
      echo "<tr>";


          for ($j = 0; $j < $field; ++$j) {
          echo "<td>    $row[$j]</td>";
          }

      echo "</tr>";
      }


    echo "</table>";

  $result->free();
  }

  $db->close();


   ?>

   <div class='link'><a href='secondpage.php' style='text-decoration: none;'>Назад</a></div>
</BODY>
</HTML>
