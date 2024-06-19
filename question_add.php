<!DOCTYPE HTML>
<HTML>

<HEAD>
    <meta charset="utf-8">
    <title>Добавление вопросов</title>
  <link rel="stylesheet" href="style6.css">

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



  if (isset($_POST['obR1']))
  {
  if (isset($_POST['FIRSTAREA1']) && isset($_POST['SECONDAREA2']) && isset($_POST['THIRDAREA3'])) {
  error_reporting(E_ERROR | E_PARSE);

  $first = htmlentities($db->real_escape_string($_POST['FIRSTAREA1']));
  $second = htmlentities($db->real_escape_string($_POST['SECONDAREA2']));
  $third = htmlentities($db->real_escape_string($_POST['THIRDAREA3']));

  $query = "SELECT ID_T FROM `THEMS` WHERE NAME='".$first."'";
  $result = $db->query($query);
  if ($result){

    $rows = $result->num_rows;
    for ($i = 0; $i < $rows; ++$i) {
    $row = $result->fetch_row();
        for ($j = 0; $j < 1; ++$j) {
        $ID_THEM=$row[$j];

        }
  }
}

$query = "INSERT INTO `QUESTIONS`(`ID_T`, `QUESTION`, `CORRECT_ANSWER`) VALUES ('$ID_THEM','$second','$third')";
$result = $db->query($query);
if ($result){

  echo "Добавлено";
}
else{
  echo "Ошибка";
}

  }

}








 $db->close();



  ?>
  <div class='container'>
      <div class='wrapper'>
        <form method='POST'>
          <label>Выберите название темы:</label>
          <div class='select'>
            <select class='select' name='FIRSTAREA1'
             <option selected ='selected'>Выберите тему</option>
             <?php
             $host = "localhost";
             $username = "root";
             $password = "";
             $database = "vkr";

             $db = new mysqli($host, $username, $password, $database);

             $query = "SELECT NAME FROM `THEMS`";
             $result = $db->query($query);
             if ($result){
               $rows = $result->num_rows;
               $fields = $result->field_count;
               for ($i = 0; $i < $rows; ++$i) {
               $row = $result->fetch_row();
                   for ($j = 0; $j < $fields; ++$j) {
                   echo "<option> $row[$j] </option>";

                   }
                 }

             }
             else{
               echo "НЕИЗВЕСТНАЯ ОШИБКА";
             }
             $db->close();

             ?>
              </select>
          </div>
          <label>Введите вопрос:</label>
          <div class='textarea'>
            <i class='fas fa-user'></i>
            <textarea class='textarea' style='width:400px; height:100px;' name='SECONDAREA2' placeholder='Вопрос...' required></textarea>
          </div>
          <label>Введите верный ответ в виде SQL-запроса:</label>
          <div class='textarea'>
            <i class='fas fa-user'></i>
            <textarea class='textarea' style='width:400px; height:100px;' name='THIRDAREA3' placeholder='Ответ...' required></textarea>
          </div>
    <div class='row button'>
          <input type='submit' input name='obR1' style='width:300px; height:50px;' value='Загрузить вопрос' id='openMyPopup' data-popup='myPopup' onClick='openPopup('#myPopup')' aria-controls='myPopup' aria-label='Open popup'/>
    </div>


        </form>
      </div>
    </div>


</BODY>
</HTML>
