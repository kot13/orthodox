<?php
namespace Orthodox\Rules;

class RequiredRule
{
    public function run($value, $input, $args)
    {
        $value = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $value);
        return !empty($value);
    }

    public function error()
    {
        return 'Field is required.';
    }
}