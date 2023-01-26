<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Repository\RuleRepository;

class RuleService extends RuleRepository
{
    public $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function verifyRules(Array $rules): Array
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