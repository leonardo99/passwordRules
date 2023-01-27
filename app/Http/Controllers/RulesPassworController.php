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
        $result = $this->ruleService->verifyRules($this->request->rules);

        return response()->json($result, $result['verify'] ? 200 : 422);
    }
}
