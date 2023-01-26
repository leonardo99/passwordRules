<?php

namespace App\Services;

use Illuminate\Http\Request;

class RuleService 
{
    public $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }
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

    protected function minSize(String $name, Int $value) {
        $expression = "/[_@.\/!#$%^&*\(\)+-\{\}\[\]]{{$value},}/i";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minSpecialChars(String $name, Int $value) {
        //(?:.*[-+_!@#$%^&*., ?]) representa pelo menos um caractere especial.
        $expression = "/(?:.*[_@.\/!#$%^&*\(\)+-\{\}\[\]]){{$value},}/i";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minUppercase(String $name, Int $value) {
        //(?:.*[A-Z]) representa pelo menos um caractere maiúsculo.
        $expression = "/(?:.*[A-Z]){{$value},}/";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minLowercase(String $name, Int $value) {
        //(?:.*[a-z]) representa pelo menos um caractere minúsculo.
        $expression = "/(?:.*[a-z]){{$value},}/";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minDigit(String $name, Int $value) {
        //(?:.*[a-z]) representa pelo menos um caractere minúsculo.
        $expression = "/(?:.*[0-9]){{$value},}/";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }
    
    protected function noRepeted(String $name) {
        $expression = "/(.)\\1+/i";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password) ? 0 : 1];
    }
}