<?php

namespace App\Services;

class RuleService 
{
    public function verifyRules($rules)
    {
        $validationResult = [];
        try {
            foreach ($rules as $key => $rule) {
                call_user_func_array(array($this, $rule['rule']), array($rule['rule'], $rule['value']))['verify'] ? '' : array_push($validationResult, call_user_func_array(array($this, $rule['rule']), array($rule['rule'], $rule['value']))['rule']);
            }
            
            return sizeof($validationResult) ? ["verify" => false, "noMatch" => $validationResult] : ["verify" => true, "noMatch" => $validationResult];
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}