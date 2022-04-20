<?php
$link = mysqli_connect('localhost', 'root', '', 'mysql');

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}
if(count(mysqli_fetch_all($link->query('SELECT * FROM engine WHERE engineId = '.$_POST['engDelId'].''))) === 0)
{mysqli_close($link); print("Ошибка при удалении. Проверьте, существует ли запись с введенным идентификатором"); return 0;}
if($link->query('DELETE FROM engine WHERE engineId = '.$_POST['engDelId'].'') === true)
{mysqli_close($link); printf("Удаление движка успешно!");;}
else {mysqli_close($link); printf("Ошибка при удалении. Возможно, удаляемый движок является внешним ключом браузера!");;}
?>