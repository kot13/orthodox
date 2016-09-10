<?php
namespace Orthodox;

use Closure;

class Orthodox
{
    public $errors = [];
    
    protected $input = [];

    protected $customRules = [];

    protected $customMessages = [];

    /**
     * @param array $data
     * @param array $rules
     *
     * @return $this
     */
    public function validate(array $data, array $rules)
    {
        $this->errors = [];
        $this->input = $data;

        $fields = array_unique(array_merge(array_keys($data), array_keys($rules)));

        foreach ($fields as $field) {
            if (isset($rules[$field])) {
                $value = isset($data[$field]) ? $data[$field] : null;
                $fieldRules = explode('|', $rules[$field]);

                foreach ($fieldRules as $rule) {
                    $continue = $this->validateAgainstRule($field, $value, $this->getRuleName($rule), $this->getRuleArgs($rule));

                    if (!$continue) {
                        break;
                    }
                }
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function passes()
    {
        return empty($this->errors);
    }

    /**
     * @return bool
     */
    public function fails()
    {
        return !$this->passes();
    }

    /**
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * @param  string $rule
     *
     * @return bool
     */
    protected function ruleHasArgs($rule)
    {
        return isset(explode('(', $rule)[1]);
    }

    /**
     * @param  string $rule
     *
     * @return array
     */
    protected function getRuleArgs($rule)
    {
        if (!$this->ruleHasArgs($rule)) {
            return [];
        }

        list($ruleName, $argsWithBracketAtTheEnd) = explode('(', $rule);

        $args = rtrim($argsWithBracketAtTheEnd, ')');
        $args = preg_replace('/\s+/', '', $args);
        $args = explode(',', $args);

        return $args;
    }

    /**
     * @param  string $rule
     *
     * @return string
     */
    protected function getRuleName($rule)
    {
        return explode('(', $rule)[0];
    }

    /**
     * @param  string $field
     * @param  string $value
     * @param  string $rule
     * @param  array $args
     *
     * @return boolean
     */
    protected function validateAgainstRule($field, $value, $rule, array $args)
    {
        if (isset($this->customRules[$rule])) {
            $passed = call_user_func_array($this->customRules[$rule], [$value, $this->input, $args]);

            if (!$passed) {
                $this->errors[$field][] = $this->customMessages[$rule];

                return false;
            }
        } else {
            $ruleClass = 'Orthodox\\Rules\\' . ucfirst($rule) . 'Rule';
            $ruleObject = new $ruleClass();

            $passed = $ruleObject->run($value, $this->input, $args);

            if (!$passed) {
                $this->errors[$field][] = $ruleObject->error();

                return false;
            }
        }
        return true;
    }

    /**
     * @param string $name
     * @param Closure $callback
     * @param string $errorMessage
     */
    public function addRule($name, Closure $callback, $errorMessage)
    {
        $this->customRules[$name] = $callback;

        $this->customMessages[$name] = $errorMessage;
    }
}