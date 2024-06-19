<!DOCTYPE HTML>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <title>Список тем</title>
  <link rel="stylesheet" href="style1.css">

</HEAD>
<BODY>
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "vkr";

    $db = new mysqli($host, $username, $password, $database);

    $query = "SELECT THEMS.ID_T, THEMS.NAME FROM THEMS JOIN QUESTIONS ON THEMS.ID_T=QUESTIONS.ID_T GROUP BY THEMS.ID_T, THEMS.NAME";

    //$query = "SELECT ID_T, NAME FROM THEMS";

    $result = $db->query($query);

    if ($result) {


    $rows = $result->num_rows;

    echo "<table>
        ";
        echo "
        <tr>
            ";
        echo "</tr>";


        $count=1;
        for ($i = 0; $i < $rows; ++$i) {
        $row = $result->fetch_row();
        echo "<tr>";


            for ($j = 1; $j < 2; ++$j) {
            echo "<td><a href=testing.php?pageid=".$row[0]." style='text-decoration: none;'>$row[1]</a><br></td>";
            $count=$count+1;
            }

        echo "</tr>";
        }
        echo " </table>";



    //$result->free();
    }

    error_reporting(E_ERROR | E_PARSE);
    session_start();
    $get=$_SESSION['IDI'];

    $querynew = "SELECT NAME FROM STUDENTS WHERE ID_S='".$get."'";
    $resultnew = $db->query($querynew);
    $rowsnew = $resultnew->num_rows;
    if ($resultnew){


      for ($i = 0; $i < $rowsnew; ++$i) {
      $rownew = $resultnew->fetch_row();
          for ($j = 0; $j < 1; ++$j) {
          $NAME_STUD=$rownew[$j];

          }
    }
    session_start();
    $_SESSION['NAME_S']=$NAME_STUD;

    $db->close();


  echo "<div class ='label'><td>Вы вошли как: $NAME_STUD </td></div>";
  echo "<div class ='signup_link'><a href='history.php' style='text-decoration: none; id='linka' '>История результатов</a></div>";

  }
 ?>


<div class='link'><a href='index.php' style='text-decoration: none;'>Выход</a></div>

</BODY>
</HTML>
