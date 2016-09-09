<?php
require '../vendor/autoload.php';

use Orthodox\Orthodox;

$data = [
    'username'          => 'demo',
    'email'             => 'kot_tdf@mail.ru',
    'age'               => 29,
    'password'          => 'qwerty',
    'password_confirm'  => 'qwerty',
];
$rules = [
    'username'          => 'required',
    'email'             => 'required|email',
    'age'               => 'number|min(18, number)|max(28, number)',
    'password'          => 'required',
    'password_confirm'  => 'required|matches(password)'
];

$o = new Orthodox;

$o->validate($data, $rules);

if ($o->passes()) {
    echo 'Passed!';
} else {
    echo 'Not passed!';

    echo '<pre>';
    print_r($o->errors());
    echo '</pre>';
}