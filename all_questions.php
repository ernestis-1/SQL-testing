<!DOCTYPE HTML>
<HTML>

<HEAD>
    <meta charset="utf-8">
    <title>Все вопросы</title>
  <link rel="stylesheet" href="style4.css">

</HEAD>
<BODY>
  <?php


  session_start();
  $NAME_TEA=$_SESSION['NAME_T'];
  echo "<div class ='label'><td>Вы вошли как: $NAME_TEA </td></div>";
  echo "<div class='link'><a href='teacher_page.php' style='text-decoration: none;'>Назад</a></div>";


  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "vkr";

  $db = new mysqli($host, $username, $password, $database);


  $query = "SELECT QUESTIONS.ID_Q, THEMS.NAME, QUESTIONS.QUESTION FROM QUESTIONS JOIN THEMS ON QUESTIONS.ID_T=THEMS.ID_T ORDER BY THEMS.ID_T";
  $result = $db->query($query);
  if ($result) {
    $rows = $result->num_rows;
    $field = $result->field_count;

    echo " <table>
    	<thead>
    		<tr>
    			<th>Номер вопроса</th>
    			<th>Название темы</th>
    			<th>Вопрос</th>
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
  else {
    echo "НЕИЗВЕСТНАЯ ОШИБКА";
  }


 $db->close();
  ?>


</BODY>
</HTML>
