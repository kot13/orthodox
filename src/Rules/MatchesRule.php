<?php
namespace Orthodox\Rules;

class MatchesRule implements RuleInterface
{
    public function run($value, $input, $args)
    {
        return $value === $input[$args[0]];
    }

    public function error()
    {
        return 'Value must match.';
    }
}