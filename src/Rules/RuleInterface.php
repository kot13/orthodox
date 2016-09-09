<?php
namespace Orthodox\Rules;

interface RuleInterface
{
    /**
     * @param  mixed $value
     * @param  array $input
     * @param  array $args
     *
     * @return bool
     */
    public function run($value, $input, $args);

    /**
     * @return string
     */
    public function error();
}