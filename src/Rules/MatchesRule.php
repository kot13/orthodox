<?php
namespace Orthodox\Rules;

class MatchesRule
{
    public function run($value, $input, $args)
    {
        return $value === $input[$args[0]];
    }

    public function error()
    {
        return 'Field must match.';
    }
}