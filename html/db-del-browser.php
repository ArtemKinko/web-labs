<?php
$link = mysqli_connect('localhost', 'root', '', 'mysql');

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}
    if(count(mysqli_fetch_all($link->query('SELECT * FROM browser WHERE browserId = '.$_POST['browDelId'].''))) === 0)
    {mysqli_close($link); print("Ошибка при удалении. Проверьте, существует ли запись с введенным идентификатором"); return 0;}
    if($link->query('DELETE FROM browser WHERE browserId = '.$_POST['browDelId'].'') === true)
    {mysqli_close($link); print("Удаление браузера успешно!");}
else {mysqli_close($link); print("Ошибка при удалении. Проверьте, существует ли запись с введенным идентификатором");}
?>