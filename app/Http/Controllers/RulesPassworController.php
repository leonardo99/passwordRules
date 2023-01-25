<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RulesPassworController extends Controller
{
    public $request;
    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function verify(Request $request) 
    {
        // dd($request->rules);
        dd($this->rulesArray($this->request->rules));
        // return response()->json([
        //     "password" => $request->password, 
        //     "rules" => $request->rules
        // ]);
    }
   
    public function rulesArray($rules)
    {
        $validationResult = [];

        foreach ($rules as $key => $rule) {
            array_push($validationResult, call_user_func_array(array($this, $rule['rule']), array($rule['rule'], $rule['value'])));
        }
        
        return $validationResult;
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
}
