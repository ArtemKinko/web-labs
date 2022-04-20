<?php
    $link = mysqli_connect('localhost', 'root', '', 'mysql');
    printf("Готово!");

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

    if($link->query('INSERT INTO engine (engineName, engineLicense, engineLanguage, engineRelease)
                    VALUES ("'.$_POST['engName'].'",
                    "'.$_POST['engLicense'].'",
                    "'.$_POST['engLanguage'].'",
                    "'.$_POST['engDate'].'")') === true)
        print("Хорошо");
    else print("Bad");
    mysqli_close($link);
?>