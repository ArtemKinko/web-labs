// Вариант 14.
// В матрице найти сумму элементов строк, в которых нет отрицательных чисел

// создаем массив
arr = [[-1, 2, 3],
    [4, 5, 6],
    [7, 8, -9]];
// инициируем переменную суммы
sum = 0;
//цикл по строкам
for (i = 0; i < arr.length; i++) {
    hasNegative = 0;
    // временная переменная, сумма всех элементов текущей строки
    row_sum = 0;
    // цикл по столбцам
    for (j = 0; j < arr[i].length; j++) {
        if (arr[i][j] < 0)
            hasNegative = 1;
        else
            row_sum += arr[i][j];
    }
    if (!hasNegative)
        sum += row_sum;
}
sum
