<?php
namespace Orthodox\Rules;

class NumberRule
{
    public function run($value, $input, $args)
    {
        return is_numeric($value);
    }

    public function error()
    {
        return 'Field must be a number.';
    }
}