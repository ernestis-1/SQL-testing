<!DOCTYPE HTML>
<HTML>

<HEAD>
    <meta charset="utf-8">
    <title>Добавление тем</title>
  <link rel="stylesheet" href="style7.css">

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

  if (isset($_POST['obR2']))
  {
  if (isset($_POST['FIRSTAREA11']) && isset($_POST['SECONDAREA22']) && isset($_POST['THIRDAREA33'])) {
  error_reporting(E_ERROR | E_PARSE);

  $first = htmlentities($db->real_escape_string($_POST['FIRSTAREA11']));
  $second = htmlentities($db->real_escape_string($_POST['SECONDAREA22']));
  $third = htmlentities($db->real_escape_string($_POST['THIRDAREA33']));

$query = "INSERT INTO `THEMS`(`NAME`, `COUNT_Q`, `MAX_BALL`) VALUES ('$first','$second','$third')";
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

 echo "<div class='container'>
     <div class='wrapper'>
       <form method='POST'>
         <label>Введите название новой темы:</label>
         <div class='textarea'>
           <i class='fas fa-user'></i>
           <textarea class='textarea' style='width:300px; height:80px;' name='FIRSTAREA11' placeholder='Тема...'></textarea>
         </div>

         <label>Введите число вопросов в тесте по теме:</label>
         <div class='textarea'>
           <i class='fas fa-user'></i>
           <textarea class='textarea' style='width:300px; height:50px;' name='SECONDAREA22' placeholder='Целое число...'></textarea>
         </div>
         <label>Введите максимальный балл по ней:</label>
         <div class='textarea'>
           <i class='fas fa-user'></i>
           <textarea class='textarea' style='width:300px; height:50px;' name='THIRDAREA33' placeholder='Целое число...'></textarea>
         </div>
   <div class='row button'>
         <input type='submit' input name='obR2' style='width:300px; height:50px;' value='Загрузить тему' id='openMyPopup' data-popup='myPopup' onClick='openPopup('#myPopup')' aria-controls='myPopup' aria-label='Open popup'/>
   </div>";
  ?>



</BODY>
</HTML>
