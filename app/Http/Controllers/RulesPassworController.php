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
        $this->rulesArray($this->request->rules);
        // return response()->json([
        //     "password" => $request->password, 
        //     "rules" => $request->rules
        // ]);
    }
   
    public function rulesArray($rules)
    {
        foreach ($rules as $key => $rule) {
            // dd($rule);
           dd(call_user_func_array(array($this, $rule['rule']), array($rule['rule'], $rule['value'])));
        }
    }

    protected function minSize(String $name, Int $value) {
        $expression = "/[\w_@.\/!#&+-]{{$value},}/i";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }
}
