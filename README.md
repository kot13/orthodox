# Orthodox

Простой валидатор без зависимостей

## Пример использования

Имеем такой набор данных:
```
$data = [
    'username' => 'demo',
    'email' => 'demo@example.com',
    'age' => 29,
    'parents' => [
        'mother' => [
            'fullName' => 'Mother',
            'age' => 'Forty',
        ],
        'father' => [
            'fullName' => ''
        ],
    ],
];
```

И такие правила валидации:

```
$rules = [
    'username'                  => 'required',
    'email'                     => 'required|email',
    'age'                       => 'number',
    'parents.mother.fullName'   => 'required',
    'parents.mother.age'        => 'number',
    'parents.father.fullName'   => 'required',
];
```

Вот так можно отвалидировать набор данных:

```
$o = new Orthodox;
$o->validate($data, $rules);
```

Проверить валидность:

```
if ($o->passes()) {
    echo "Passed!\n\r";
} else {
    echo "Not passed!\n\r";
    print_r($o->errors());
    echo "\n\r";
}
```

и получить массив ошибок

```
Array
(
    [parents.mother.age] => Array
        (
            [0] => Value must be a number.
        )

    [parents.father.fullName] => Array
        (
            [0] => Value is required.
        )

)
```