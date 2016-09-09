<?php
namespace Orthodox\Rules;

class MinRule implements RuleInterface
{
    public function run($value, $input, $args)
    {
        $number = isset($args[1]) && $args[1] === 'number';
        if ($number) {
            return (float) $value >= (float) $args[0];
        }
        return mb_strlen($value) >= (int) $args[0];
    }

    public function error()
    {
        return 'Value too small.';
    }
}