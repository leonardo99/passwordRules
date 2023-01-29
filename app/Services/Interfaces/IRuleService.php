<?php

namespace App\Services\Interfaces;

interface IRuleService
{
    public function verifyRules(Array $rules): Array;
}