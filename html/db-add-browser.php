<?php
$link = mysqli_connect('localhost', 'root', '', 'mysql');
printf("Готово!");

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

if($link->query('INSERT INTO browser (browserName, browserDev, browserStatus, engineId)
                    VALUES ("'.$_POST['browName'].'",
                    "'.$_POST['browDev'].'",
                    "'.$_POST['browStatus'].'",
                    "'.$_POST['browEngine'].'")') === true)
    print("Хорошо");
else print("Bad");
mysqli_close($link);
?>