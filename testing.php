
<!DOCTYPE html>
<HEAD>
    <meta charset="utf-8">
    <title><?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "vkr";
    $db = new mysqli($host, $username, $password, $database);
    $pageid = $_GET['pageid'];


    $query = "SELECT NAME FROM THEMS WHERE ID_T='".$pageid."'";

    $result = $db->query($query);
    if ($result) {
    $rows = $result->num_rows;
    for ($i = 0; $i < $rows; ++$i) {
    $row = $result->fetch_row();
    $NAME_THEM=$row[0];
    }
  }
  $db->close();

      echo "Тема $pageid. $NAME_THEM"; ?></title>
    <link rel="stylesheet" href="style2.css">

</HEAD>
<html>
<BODY>
<?php


    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "vkr";

   session_start();
   $pageid = $_GET['pageid'];


    $db = new mysqli($host, $username, $password, $database);


    session_start();
    $name_s=$_SESSION['NAME_S'];
    echo "<div class ='label'>Вы вошли как: $name_s</div>";

    session_start();
    $_SESSION['IDI_T']=$pageid;
    $iditheme=$pageid;
    session_start();
    $_SESSION['iditheme']=$iditheme;
    if (!isset($_POST['obR']))
    {

    $query = "SELECT COUNT_Q FROM THEMS WHERE ID_T='".$pageid."'";

    $result = $db->query($query);

    if ($result) {
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
    $row = $result->fetch_row();
    $COUNT_Q=$row[0];

    }

  }



    $query = "SELECT ID_Q, QUESTION, CORRECT_ANSWER FROM QUESTIONS WHERE ID_T='".$pageid."' ORDER BY RAND() LIMIT 0, 100";

    $result = $db->query($query);




    if ($result) {


    $rows = $result->num_rows;

    echo "<table>
        ";
        echo "
        <tr>
            ";
        echo "</tr>";


        $array = array();

        for ($i = 1; $i < $COUNT_Q+1; ++$i) {
        $row = $result->fetch_row();
        echo "<tr>";

           array_push($array, $row[0],$row[1],$row[2]);


        echo "</tr>";
        }
        echo " </table>";



    $result->free();




}


  $array_correct = array();
  for ($i = 2; $i <= $COUNT_Q*3-1; $i+=3) {

  echo "<tr>";

     array_push($array_correct, $array[$i]);


  echo "</tr>";
  }
  echo " </table>";





$db->close();



session_start();
$_SESSION['COR_F']=$array_correct;



}


$database1 = "project_work";
if (isset($_POST[1])) {

  session_start();
  $array_correct=$_SESSION['COR_F'];

error_reporting(E_ERROR | E_PARSE);


$array_rows = array();
$array_fields = array();
$db = new mysqli($host, $username, $password, $database1);

for ($i=0; $i < count($array_correct); ++$i) {
 $correct=$db->query($array_correct[$i]);
 $rows_correct = $correct->num_rows;
 $field_correct = $correct->field_count;

  array_push($array_rows, $rows_correct);
  array_push($array_fields, $field_correct);

}


      $STUDENT_RESULT=0;

      $array_student=array();
      $array_student_rows = array();
      $array_student_fields = array();

      for ($i=1; $i <count($array_correct)+1; ++$i) {
        $stud=htmlentities($db->real_escape_string($_POST["$i"]));
        $studnew=stripslashes($stud);
        $student_res = $db->query($studnew);
        $rows_stud = $student_res->num_rows;
        $field_stud = $student_res->field_count;
        array_push($array_student, $studnew);
        array_push($array_student_rows, $rows_stud);
        array_push($array_student_fields, $field_stud);
      }

    

        //echo $array_student[0];

      error_reporting(E_ERROR | E_PARSE);


      for ($i=0; $i < count($array_correct); ++$i) {
        $PLO_RES=0;
        $PLO=$array_rows[$i]*$array_fields[$i];

        if ($array_student_rows[$i]==$array_rows[$i])
        {

          if($array_student_fields[$i]==$array_fields[$i])
          {
           $correct_sql = $db->query($array_correct[$i]);
           $student_sql = $db->query($array_student[$i]);
             for ($j=0; $j < $array_rows[$i]; ++$j)
             {
               $row_correct = $correct_sql->fetch_row();
               $row_student = $student_sql->fetch_row();
               for ($z=0; $z < $array_fields[$i]; ++$z) {
                 if ($row_correct[$z]==$row_student[$z]){
                   $PLO_RES=$PLO_RES+1;

               }
             }


          }

        }
      }

      if ($PLO_RES==$PLO && $PLO_RES!=0)
      {
        $STUDENT_RESULT=$STUDENT_RESULT+1;
      }
    }


$db->close();

get_included_files('register.php');
session_start();
$_SESSION['STUD_RES']=$STUDENT_RESULT;
header("Location: results.php");





}


$count=1;
echo "
<div class='container'>
    <div class='wrapper'>
      <form method='POST'>";


for ($i=1; $i <$COUNT_Q*3-1 ; $i+=3) {
  echo "

  <label>$count.$array[$i]</label>
  <div class='textarea'>
    <i class='fas fa-user'></i>
    <textarea class='textarea' id='fs' style='width:700px; height:150px; top=20px;' name='$count' placeholder='Введите ответ...' ></textarea>
  </div>
  ";
  $count++;
}

echo "
<div class='row button'>
     <input type='submit' input name='obR' style='width:300px; height:50px;' value='Проверить и отправить результаты' id='openMyPopup' data-popup='myPopup' onClick='openPopup('#myPopup')' aria-controls='myPopup' aria-label='Open popup'/>
</div>
 </form>
 </div>
 </div>"

?>



<div class='signup-link'><a href='secondpage.php' style='text-decoration: none;'>Закончить тестирование</a></div>




<div id="timer"></div>

<script type="text/javascript">
var countDownDate = new Date();
countDownDate.setMinutes(countDownDate.getMinutes() + 15);

var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;

    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML = "Осталось: " + minutes + " : " + seconds;

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "Время истекло";
        window.location.href = 'results.php';

    }
}, 1000);
</script>

</BODY>
</html>
