<?php
require '../vendor/autoload.php';

use Orthodox\Orthodox;

$data = [
    'username'          => 'demo',
    'email'             => 'kot_tdf@mail.ru',
    'age'               => 29,
    'favorite_fruit'    => 'apple',
    'password'          => 'qwerty',
    'password_confirm'  => 'qwerty',
];

$rules = [
    'username'          => 'required',
    'email'             => 'required|email',
    'age'               => 'number|min(18, number)|max(28, number)',
    'favorite_fruit'    => 'isApple',
    'password'          => 'required',
    'password_confirm'  => 'required|matches(password)'
];

$o = new Orthodox;

$o->addRule('isApple', function($value, $input, $args) {
    return $value === 'apple';
}, 'This is not an apple');

$o->validate($data, $rules);

if ($o->passes()) {
    echo 'Passed!';
} else {
    echo 'Not passed!';

    echo '<pre>';
    print_r($o->errors());
    echo '</pre>';
}