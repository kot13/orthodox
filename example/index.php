<?php
require '../vendor/autoload.php';

use Orthodox\Orthodox;

$data = [
    'username'          => 'demo',
    'email'             => 'kot_tdf@mail.ru',
    'password'          => 'qwerty',
    'password_confirm'  => 'qwerty',
];
$rules = [
    'username'          => 'required',
    'email'             => 'required|email',
    'password'          => 'required',
    'password_confirm'  => 'required|matches(password)'
];

$o = new Orthodox;

$o->validate($data, $rules);

if ($o->passes()) {
    echo 'Passed!';
} else {
    echo 'No passed!';

    echo '<pre>';
    print_r($o->errors());
    echo '</pre>';
}