<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Форма регистрации</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
  <?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "vkr";



    if (isset($_POST['NAME']) && isset($_POST['LOG']) && isset($_POST['PASS']) && isset($_POST['CODE'])) {
    $db = new mysqli($host, $username, $password, $database);
    if ($db->connect_error) {
        die('error ' .
            $db->connect_errno . ' ' .
            $db->connect_error);
    }
    $name = htmlentities($db->real_escape_string($_POST['NAME']));
    $log = htmlentities($db->real_escape_string($_POST['LOG']));
    $pass = htmlentities($db->real_escape_string($_POST['PASS']));
    $code = htmlentities($db->real_escape_string($_POST['CODE']));

    if ($code==1){

    $query = "INSERT INTO `STUDENTS`(`NAME`, `LOG`, `PASS`) VALUES ('$name','$log','$pass')";
    $result = $db->query($query);
    if ($result){
        header("Location: secondpage.php");
    }
    else{
    echo "<span style = 'color:red'>Ошибка!!!</span>";
    }

  }elseif ($code=="AzPyUI" || $code=="tYiOP") {
    $query = "INSERT INTO `TEACHERS`(`NAME`, `LOG`, `PASS`) VALUES ('$name','$log','$pass')";
    $result = $db->query($query);
    if ($result){
        header("Location: teacher_page.php");
      }
    else{
    echo "<span style = 'color:red'>Ошибка!!!</span>";
    }
  }
  else{echo "<span style = 'color:red'>Неверный код!!!</span>"; }

    $db->close();
}


    echo  "<div class='container'>
      <div class='wrapper'>
        <div class='title'><span>Форма регистрации</span></div>
        <form method='POST'>
	  <div class='row'>
            <i class='fas fa-user'></i>
            <input type='text' name='NAME' placeholder='ФИО' required/>
          </div>
          <div class='row'>
            <i class='fas fa-envelope-open'></i>
            <input type='email' name='LOG' placeholder='Email' required/>
          </div>
          <div class='row'>
            <i class='fas fa-lock'></i>
            <input type='password' name='PASS' placeholder='Пароль' required/>
          </div>
          <div class='row'>
            <i class='fas fa-key'></i>
            <input type='password' name='CODE' placeholder='Кодовое слово(для студентов — 1)' required/>
          </div>
	  <div class='row button'>
          <input type='submit' value='Зарегистрироваться'/>
	  </div>
          <div class='signup-link'><a href='index.php'>Назад на вход</a></div>
        </form>
      </div>
    </div>";
   ?>
  </body>
</html>
