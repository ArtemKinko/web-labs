<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script>

            $(document).ready(function() {
                $("#addEngine").on("click",function(){
                    $.post({url: 'db-add-engine.php',
                        data: $("#engineForm").serialize(),
                        success: function () {alert("Вставка успешна!"); },
                        error: function () {alert("Одно или несколько полей заполнены неккоректно. Вставка невозможна!"); }
                    })
                })
                });

            $(document).ready(function() {
                $("#addBrowser").on("click",function(){
                    $.post({url: 'db-add-browser.php',
                        data: $("#browserForm").serialize(),
                        success: function () {alert("Вставка успешна!"); },
                        error: function () {alert("Одно или несколько полей заполнены неккоректно. Вставка невозможна!"); }
                    })
                })
            });

            $(document).ready(function() {
                $("#delBrowser").on("click",function(){
                    $.post({url: 'db-del-browser.php',
                        data: $("#browserDelForm").serialize(),
                        success: function (data) {alert(data); },
                        error: function () {alert("Идентификатор задан неверно. Удаление невозможно!"); }
                    })
                })
            });

            $(document).ready(function() {
                $("#delEngine").on("click",function(){
                    $.post({url: 'db-del-engine.php',
                        data: $("#engineDelForm").serialize(),
                        success: function (data) {alert(data); },
                        error: function () {alert("Идентификатор задан неверно. Удаление невозможно!"); }
                    })
                })
            });

            openInfo = function () {
                alert("Сайт разработан Кинько Артемом, группа 4931, artem.kinko.edu@gmail.com");
            }
        </script>

        <meta charset="UTF-8">
        <title>Сравнение браузеров</title>
        <style>
            table, th, td {
                text-align: center;
                border: 1px solid black;
            }
            table {
                width: 100%;
            }
            footer {
                background-color: rgb(192, 192, 192);
            }


            tr:nth-child(odd) {
                background-color: #d8fdd8;
            }

            tr:nth-child(even) {
                background-color: #fdf0d8;
            }

            textarea {
                resize: none;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header style="text-align: center" >
            <p><a name="top"></a></p>
            <img src="../images/logo_with_title.png" alt="logo_with_title">
            <h1>Конкуренция браузеров. Таблицы движков.</h1> <br>
        </header>

        <nav style="margin-left: 10%">
            <h2>Навигация по сайту:</h2>
            <ul>
                <li><a href="main-page.html">Историческая справка</a></li>
                <ul>
                    <li><a href="main-page.html#web-history">История появления первых веб-браузеров</a></li>
                    <li><a href="main-page.html#first_war">Первая война браузеров</a></li>
                    <li><a href="main-page.html#second_war">Вторая война браузеров</a></li>
                </ul>
                <li><a href="comparison-page.html">Сравнение браузеров</a></li>
                <ul>
                    <li><a href="comparison-page.html#characteristics">Основные характеристики для сравнения</a></li>
                    <li><a href="comparison-page.html#browsers_table">Таблица сравнения популярных браузеров</a></li>
                    <li><a href="comparison-page.html#features">Важные функции при выборе браузера</a></li>
                </ul>
                <li><a href="engine-page.php">Таблица движков</a></li>
                <li><a href="task-page.html">Решение задачи поиска минимума</a></li>
                <li><a href="../form.htm">Обратная связь</a></li>
                <li><a href="gallery-page.html">Галерея сайта</a></li>
                <li><a href="sources-page.html">Использованные источники</a></li>
            </ul>
        </nav>

        <main style="text-align: center">
            <br><br>
            <h2>Таблица движков.</h2>
            <section style="width: 80%; margin-left: 10%; text-align: justify">
                <table id="engineTable">
                    <tr>
                        <th style="background-color: lightgray">Идентификатор</th>
                        <th style="background-color: lightgray">Название движка</th>
                        <th style="background-color: lightgray">Лицензия</th>
                        <th style="background-color: lightgray">Язык программирования</th>
                        <th style="background-color: lightgray">Дата выпуска</th>
                    </tr>

                    <?php
                    $link = mysqli_connect('localhost', 'root', '', 'mysql');
                    if (!$link) {
                        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
                        exit;
                    }
                    if ($result = mysqli_query($link, 'SELECT engineId, engineName, engineLicense, engineLanguage, engineRelease FROM engine')) {
                        while( $row = mysqli_fetch_assoc($result) ){
                            printf('<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr>',
                                $row['engineId'], $row['engineName'], $row['engineLicense'],
                                $row['engineLanguage'], $row['engineRelease']);
                        }
                        mysqli_free_result($result);
                    }
                    mysqli_close($link);
                    ?>
                    <form id="engineForm" method="post">
                        <label>Добавьте свой движок: </label>
                        <input type="text" name="engName" value="Название"/>
                        <input type="text" name="engLicense" value="Лицензия"/>
                        <input type="text" name="engLanguage" value="Язык"/>
                        <input type="text" name="engDate" value="2020-03-10"/>
                        <input type="submit" id="addEngine"/>
                    </form>
                </table>
                <form id="engineDelForm" method="post">
                    <label>Удалите запись о браузере: </label>
                    <input type="number" name="engDelId" value="1"/>
                    <input type="submit" id="delEngine"/>
                </form>
            </section>


            <br><br>
            <h2>Таблица браузеров.</h2>
            <section style="width: 80%; margin-left: 10%; text-align: justify">
                <table id="browserTable">
                    <tr>
                        <th style="background-color: lightgray">Идентификатор</th>
                        <th style="background-color: lightgray">Название браузера</th>
                        <th style="background-color: lightgray">Разработчик</th>
                        <th style="background-color: lightgray">Статус разработки</th>
                        <th style="background-color: lightgray">Название движка</th>
                    </tr>

                    <?php
                    $link = mysqli_connect('localhost', 'root', '', 'mysql');
                    if (!$link) {
                        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
                        exit;
                    }
                    if ($result = mysqli_query($link, 'SELECT browserId, browserName, browserDev, browserStatus, engineName FROM browser
                        JOIN engine on browser.engineId = engine.engineId')) {
                        while( $row = mysqli_fetch_assoc($result) ){
                            printf('<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr>',
                                $row['browserId'], $row['browserName'], $row['browserDev'],
                                $row['browserStatus'], $row['engineName']);
                        }
                        mysqli_free_result($result);
                    }
                    mysqli_close($link);
                    ?>
                    <form id="browserForm" method="post">
                        <label>Добавьте свой браузер: </label>
                        <input type="text" name="browName" value="Название"/>
                        <input type="text" name="browDev" value="Разработчик"/>
                        <input type="text" name="browStatus" value="Статус"/>
                        <input type="number" name="browEngine" value="1"/>
                        <input type="submit" id="addBrowser"/>
                    </form>
                </table>
                <form id="browserDelForm" method="post">
                    <label>Удалите запись о браузере: </label>
                    <input type="number" name="browDelId" value="1"/>
                    <input type="submit" id="delBrowser"/>
                </form>
            </section>
        </main>

        <footer style="text-align: right; margin-right: 5%">
            <h3><p><a href="#top">Наверх</a></p></h3>
            <h3><p><a href="#footer" onclick="openInfo()">Об авторе</a></p></h3>
        </footer>
    </body>
</html>