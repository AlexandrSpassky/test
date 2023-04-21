<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Форма обратной связи</title>
</head>
<body>
<?php
    $link = mysqli_connect ("localhost", "root", "", "test");
    $sql = "SELECT * FROM `form`";
    $result = mysqli_query($link, $sql);
    

    $name = $addres = $phone = $email = "";
    $nameErr = $addresErr = $phoneErr = $emailErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["name"])) {
            $nameErr = "Введите ФИО";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^(([a-zA-Z' -]{1,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{1,30}))$/u",$name)) {
                $nameErr = "Введите корректное ФИО";
            }
        }
      
        if (empty($_POST["addres"])) {
            $addresErr = "Введите адрес";
        } else {
            $addres = test_input($_POST["addres"]);
            if (!check_length($addres, 5, 100)) {
                $addresErr = "Введите корректный адрес";
            }
        }
      
        if (empty($_POST["phone"])) {
            $phoneErr = "Введите телефон";
        } else {
            $phone = test_input($_POST["phone"]);
            if(!preg_match("/^[+][0-9][0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}$/", $phone)) {
                $phoneErr = "Телефон задан в неверном формате";
            }
            
        }

        if (empty($_POST["email"])) {
          $emailErr = "Введите E-mail";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Некорректно введён email";
            }
        }

        if ($nameErr == "" && $addresErr == "" && $phoneErr == "" && $emailErr == "") {
            $sql = "INSERT INTO `form` (`name`, `addres`, `phone`, `email`) VALUES ('" . $name . "', '" . $addres . "', '" . $phone . "', '" . $email . "')";
            $resultIn = mysqli_query($link, $sql);
        }









    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }
    ?>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="form__item">
            <span class="error">* <?php echo $nameErr;?></span>
            <input class="form__input" type="text" name="name" placeholder="ФИО">
        </div>
        <div class="form__item">
            <span class="error">* <?php echo $addresErr;?></span>
            <input class="form__input" type="text" name="addres" placeholder="Адрес">
        </div>
        <div class="form__item">
            <span class="error">* <?php echo $phoneErr;?></span>
            <input class="form__input" type="text" name="phone" placeholder="Номер телефона">
        </div>
        <div class="form__item">
            <span class="error">* <?php echo $emailErr;?></span>
            <input class="form__input" type="text" name="email" placeholder="e-mail">
        </div>
        <input class="form__button" type="submit">
    </form>

    <table class="table">
        <tr><th>ФИО</th><th>Адрес</th><th>Телефон</th><th>E-mail</th></tr>
        <?php 
        while ($row = mysqli_fetch_array($result)) {
            print("<tr><td>" . $row['name'] . "</td><td>" . $row['addres'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['email'] . "</td><td></tr>");
        }
        ?>
    </table>
</body>
</html>