<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Новости</title>
</head>
<body>
    <?php
    $link = mysqli_connect ("localhost", "root", "", "test");
    $sql = "SELECT * FROM `news`";
    $result = mysqli_query($link, $sql);
    ?>
    <h1 class="title">Новости</h1>
    <div class="news">
        <?php 
            while ($row = mysqli_fetch_array($result)) {
                print("<div class='news__item'><div class='news__name'>" . $row['name'] . "</div><div class='news__date'>" . $row['date'] . "</div><div class='news__text'>" . $row['text'] . "</div></div>");
            }
        ?>
    </div>
</body>
</html>