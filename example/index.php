<?php
require '../vendor/autoload.php';

use Orthodox\Orthodox;

$dataSetFirst = [
    'username'          => 'demo',
    'email'             => 'demo@example.com',
    'age'               => 20,
    'favorite_fruit'    => 'apple',
    'password'          => 'qwerty',
    'password_confirm'  => 'qwerty',
];

$dataSetSecond = [
    'email'             => 'example.com',
    'favorite_fruit'    => 'apple',
    'password'          => 'qwerty',
    'password_confirm'  => 'qwerty',
];

$dataSetThird = [
    'username'          => 'demo',
    'email'             => 'demo@example.com',
    'age'               => 29,
    'favorite_fruit'    => 'banana',
    'password'          => 'qwerty',
    'password_confirm'  => 'qwerty2',
];

$rules = [
    'username'          => 'required',
    'email'             => 'required|email',
    'age'               => 'number|min(18, number)|max(28, number)',
    'favorite_fruit'    => 'isApple',
    'password'          => 'required',
    'password_confirm'  => 'required|matches(password)'
];

$TreeDataSet = [
    'username'          => 'demo',
    'email'             => 'demo@example.com',
    'age'               => 29,
    'parents'   => [
        'mother' => [
            'fullName' => 'Mother',
            'age'      => 'Forty',
        ],
        'father' => [
            'fullName' => ''
        ],
    ],
];

$treeRules = [
    'username'                  => 'required',
    'email'                     => 'required|email',
    'age'                       => 'number',
    'parents.mother.fullName'   => 'required',
    'parents.mother.age'        => 'number',
    'parents.father.fullName'   => 'required',
];

$o = new Orthodox;

$o->addRule('isApple', function($value, $input, $args) {
    return $value === 'apple';
}, 'This is not an apple');

$o->validate($dataSetFirst, $rules);

if ($o->passes()) {
    echo "First data set passed!\n\r";
} else {
    echo "First data set not passed!\n\r";
    print_r($o->errors());echo "\n\r";
}

$o->validate($dataSetSecond, $rules);

if ($o->passes()) {
    echo "Second data set passed!\n\r";
} else {
    echo "Second data set not passed!\n\r";
    print_r($o->errors());
    echo "\n\r";
}

$o->validate($dataSetThird, $rules);

if ($o->passes()) {
    echo "Third data set passed!\n\r";
} else {
    echo "Third data set not passed!\n\r";
    print_r($o->errors());
    echo "\n\r";
}

$o->validate($TreeDataSet, $treeRules);

if ($o->passes()) {
    echo "Tree data set passed!\n\r";
} else {
    echo "Tree data set not passed!\n\r";
    print_r($o->errors());
    echo "\n\r";
}