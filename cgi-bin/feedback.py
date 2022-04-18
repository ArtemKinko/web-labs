#!/Users/artem/Documents/SUAI/Web/web-labs/venv/bin/python
import cgi
import smtplib
from email.mime.text import MIMEText

form = cgi.FieldStorage()
print("Content­type: text/html")

# style and header
html_header = """
<head>
<meta charset="UTF-8">
        <title>Ваша обратная связь</title>
        <style>
            table, th, td {
                text-align: center;
                border: 1px solid black;
            }
            table {
                width: 80%;
                margin-left: 10%;
            }
            footer {
                width: 100%;
                background-color: rgb(192, 192, 192);
            }
        </style>
</head>
<body>
    <header style="text-align: center" >
        <p><a name="top"></a></p>
        <img src="http://localhost/images/logo_with_title.png" alt="logo_with_title">
        <h1>Конкуренция браузеров. Обратная связь.</h1> <br>
    </header>

    <nav style="margin-left: 10%">
        <h2>Навигация по сайту:</h2>
        <ul>
            <li><a href="html/main-page.html">Историческая справка</a></li>
            <ul>
                <li><a href="html/main-page.html#web-history">История появления первых веб-браузеров</a></li>
                <li><a href="html/main-page.html#first_war">Первая война браузеров</a></li>
                <li><a href="html/main-page.html#second_war">Вторая война браузеров</a></li>
            </ul>
            <li><a href="html/comparison-page.html">Сравнение браузеров</a></li>
            <ul>
                <li><a href="html/comparison-page.html#characteristics">Основные характеристики для сравнения</a></li>
                <li><a href="html/comparison-page.html#browsers_table">Таблица сравнения популярных браузеров</a></li>
                <li><a href="html/comparison-page.html#features">Важные функции при выборе браузера</a></li>
            </ul>
            <li><a href="html/task-page.html">Решение задачи поиска минимума</a></li>
            <li><a href="http://localhost/form.htm">Обратная связь</a></li>
            <li><a href="html/gallery-page.html">Галерея сайта</a></li>
            <li><a href="html/sources-page.html">Использованные источники</a></li>
        </ul>
    </nav>
    <br><br>
"""
print(html_header)

html1 = """
<H1 style="text-align: center">Ваша обратная связь</H1>
<table border =2> <tr>
"""
print(html1)

ll = ['ФИО', 'Почта', 'Тип сообщения', 'Ответ на почту', 'Сообщение']
for head in ll:
    ss = '<td><b>'+head+'</b></td>'
    print(ss)
if 'pages' in form:
    ss = '<td><b>Страницы с проблемой<b></td>'
    print(ss)
print('</tr> <tr>')

data = ['', '', '', '', '', '']
i = 0
for field in ('user_name', 'user_mail', 'user_type', 'feedback', 'user_message', 'pages'):
    if not field in form:
        data[i] = '(unknown)'
    else:
        if not isinstance(form[field], list):
            data[i] = form[field].value
        else:
            values = [x.value for x in form[field]]
            data[i] = ', '.join(values)
    i += 1
for el in data:
    if el != '(unknown)':
        print('<td> %s </td>'% el)

print('</tr></table>')
if data[3] == 'yes':
    print('<h3 style="text-align: center">Скоро Вам придет сообщение об успешной отправке.</h3>')

html_footer = """
<br><br><br><br>
<footer style="text-align: right; margin-right: 5%">
            <h3><p><a href="#top">Наверх</a></p></h3>
            <h3><p><a href="#footer" onclick="openInfo()">Об авторе</a></p></h3>
        </footer>
</body>
"""
print(html_footer)

# log file
with open('/Users/artem/Documents/SUAI/Web/web-labs/log/feedback.log', 'a') as f:
    print("#############", file=f)
    i = 0
    for el in ll:
        print(el + ": ", data[i], file=f)
        i += 1
    if 'pages' in form:
        print('Страницы с проблемами: ', data[i], file=f)
    print('\n', file=f)

# send message
if data[3] == 'yes':
    str_message = data[0] + ", мы приняли Вашу обратную связь. Вскоре напишем ответное сообщение!\n\nВаше сообщение:\n" + data[4] +"\n\nКоманда сайта Browser Competition."
    msg = MIMEText(str_message, 'plain', 'utf-8')
    smtpObj = smtplib.SMTP('smtp.gmail.com', 587)
    smtpObj.starttls()
    # ПЕРЕД ЗАПУСКОМ ВСТАВЬТЕ НИЖЕ ПОЧТУ И ЕЕ ТОКЕН ДЛЯ ДОСТУПА К РАССЫЛКЕ
    smtpObj.login('artem.kinko.dev@gmail.com', 'token')
    smtpObj.sendmail(data[1], "artem.kinko.dev@gmail.com", msg.as_string())
    smtpObj.quit()
