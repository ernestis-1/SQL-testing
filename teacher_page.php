<!DOCTYPE HTML>
<HTML>

<HEAD>
    <meta charset="utf-8">
    <title>Результаты студентов</title>
  <link rel="stylesheet" href="style4.css">

</HEAD>
<BODY>
  <?php
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "vkr";
  session_start();
  $get=$_SESSION['IDI_T'];
  $db = new mysqli($host, $username, $password, $database);

  $query = "SELECT NAME FROM `TEACHERS` WHERE ID_TEA='".$get."'";
  $result = $db->query($query);

  if ($result){

    $rows = $result->num_rows;
    for ($i = 0; $i < $rows; ++$i) {
    $row = $result->fetch_row();
        for ($j = 0; $j < 1; ++$j) {
        $NAME_TEACH=$row[$j];

        }
  }
}

  echo "<div class ='label'><td>Вы вошли как: $NAME_TEACH </td></div>";
  session_start();
  $_SESSION['NAME_T']=$NAME_TEACH;

  $query_res="SELECT STUDENTS.NAME, THEMS.NAME, RESULTS.DATE, RESULTS.GRADE, RESULTS.MAX_BALL
            FROM RESULTS JOIN THEMS ON RESULTS.ID_T=THEMS.ID_T JOIN STUDENTS ON RESULTS.ID_S=STUDENTS.ID_S ORDER BY STUDENTS.NAME";
  $result_res = $db->query($query_res);

  if ($result_res) {
  $rows_res = $result_res->num_rows;
  $field_res = $result_res->field_count;
  echo " <table>
  	<thead>
  		<tr>
  			<th>Студент</th>
  			<th>Название темы</th>
  			<th>Дата</th>
  			<th>Оценка</th>
        <th>Максимальный балл</th>
  		</tr>
  	</thead>";

    for ($i = 0; $i < $rows_res; ++$i) {
    $row_res = $result_res->fetch_row();
    echo "<tr>";


        for ($j = 0; $j < $field_res; ++$j) {
        echo "<td> $row_res[$j]</td>";
        }

    echo "</tr>";
    }

}



 echo "<div class='link'><a href='index_teacher.php' style='text-decoration: none;'>Выход</a></div>";
 echo "<div class='signup_link'><a href='question_add.php' style='text-decoration: none;'>Добавление вопросов</a></div>";
 echo "<div class='signup_link'><a href='thems_add.php' style='text-decoration: none;'>Добавление тем</a></div>";
 echo "<div class='text'><a href='all_questions.php' id = 'questions' style='text-decoration: none;'>Вопросы</a></div>";

 $db->close();
  ?>


</BODY>
</HTML>
