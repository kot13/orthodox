<?php
namespace Orthodox\Rules;

class EmailRule
{
    public function run($value, $input, $args)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function error()
    {
        return 'Field must be a valid email address.';
    }
}