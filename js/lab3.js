// Вариант 14.
// В матрице найти сумму элементов строк, в которых нет отрицательных чисел

arr = [[-1, 2, 3],
    [4, 5, 6],
    [7, 8, -9]];
sum = 0;
mainloop: for (i = 0; i < arr.length; i++) {
    row_sum = 0;
    for (j = 0; j < arr[i].length; j++) {
        if (arr[i][j] < 0)
            continue mainloop;
        else
            row_sum += arr[i][j];
    }
    sum += row_sum;
}

sum
