<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Главная страница</title>
</head>
<body>
    <?php
    $link = mysqli_connect ("localhost", "root", "", "test");
    $sql = "SELECT * FROM `news`";
    $result = mysqli_query($link, $sql);
    $i = 1;
    ?>
    <h1 class="title">Главная страница</h1>
    <div class="news">
        <?php 
            while ($i <= 3) {
                $i++;
                $row = mysqli_fetch_array($result);
                print("<div class='news__item'><div class='news__name'>" . $row['name'] . "</div><div class='news__date'>" . $row['date'] . "</div><div class='news__text'>" . stristr($row['text'], '.', true) . ".</div></div>");
            }
        ?>
    </div>
    <a class="link" href="/news.php">Все новости</a>
    <a class="link" href="/form.php">Форма обратной связи</a>
</body>
</html>