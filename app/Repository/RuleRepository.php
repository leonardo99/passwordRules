<?php

namespace App\Repository;

class RuleRepository 
{
    protected function minSize(String $name, Int $value): Array {
        $expression = "/(?:.*[^\w]){{$value},}/";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minSpecialChars(String $name, Int $value): Array {
        //(?:.*[-+_!@#$%^&*., ?]) representa pelo menos um caractere especial.
        $expression = "/(?:.*[_@.\/!#$%^&*\(\)+-\{\}\[\]]){{$value},}/i";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minUppercase(String $name, Int $value): Array {
        //(?:.*[A-Z]) representa pelo menos um caractere maiúsculo.
        $expression = "/(?:.*[A-Z]){{$value},}/";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minLowercase(String $name, Int $value): Array {
        //(?:.*[a-z]) representa pelo menos um caractere minúsculo.
        $expression = "/(?:.*[a-z]){{$value},}/";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }

    protected function minDigit(String $name, Int $value): Array {
        //(?:.*[a-z]) representa pelo menos um caractere minúsculo.
        $expression = "/(?:.*[0-9]){{$value},}/";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password)];
    }
    
    protected function noRepeted(String $name): Array {
        $expression = "/(.)\\1+/i";
        return ["rule" => $name, "verify" => preg_match($expression, $this->request->password) ? 0 : 1];
    }
}