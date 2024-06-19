<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Форма входа преподавателя</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
  <?php
   $host = "localhost";
   $username = "root";
   $password = "";
   $database = "vkr";

   if (isset($_POST['LOG']) && isset($_POST['PASS'])) {
    $db = new mysqli($host, $username, $password, $database);
    if ($db->connect_error) {
        die('error ' .
            $db->connect_errno . ' ' .
            $db->connect_error);
    }
    $log = htmlentities($db->real_escape_string($_POST['LOG']));
    $pass = htmlentities($db->real_escape_string($_POST['PASS']));

    $query = "SELECT ID_TEA FROM `TEACHERS` WHERE `LOG` ='".$log."' AND `PASS`='".$pass."'";
    $result = $db->query($query);
    $rows = $result->num_rows;
    for ($i = 0; $i < $rows; ++$i) {
    $row = $result->fetch_row();
    session_start();
    $ID_T=$row[0];
    $_SESSION['IDI_T']=$ID_T;
    }


    if ($rows==0){
                    echo'Такого пользователя не существует или неверный пароль';
                }else{
                    header("Location: teacher_page.php");
                  }

    $db->close();
}

  echo  "<div class='container'>
      <div class='wrapper'>
        <div class='title'><span>Преподаватель</span></div>
        <form method='POST'>
          <div class='row'>
            <i class='fas fa-envelope-open'></i>
            <input type='Email' name='LOG' placeholder='Email' required/>
          </div>
          <div class='row'>
            <i class='fas fa-lock'></i>
            <input type='password' name='PASS' placeholder='Пароль' required/>
          </div>
	  <div class='row button'>
          <input type='submit' value='Вход'/>
	  </div>
          <div class='signup-link'><a href='index.php'>Вход для студента</a></div>
          <div class='signup-link'><a href='register.php'>Зарегистрироваться</a></div>
        </form>
      </div>
    </div>";
   ?>
  </body>
</html>
