<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RuleService;

class RulesPassworController extends Controller
{
    public $request;
    public $ruleService;

    public function __construct(Request $request, RuleService $ruleService) {
        $this->request = $request;
        $this->ruleService = $ruleService;
    }

    public function verify(Request $request) 
    {
        return response()->json($this->ruleService->verifyRules($this->request->rules));
        // return response()->json([
        //     "password" => $request->password, 
        //     "rules" => $request->rules
        // ]);
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

    protected function functionExists ($functions) {
        foreach ($functions as $key => $function) {
            dd($function);
        }
        return function_exists($name) ? true : ["error" => "Function does not exist."];
    }
}
