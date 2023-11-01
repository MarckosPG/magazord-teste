<?php

namespace utils;

class Validations {

    public static function validateEmail ($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }else{
            return true;
        }
    }

    public static function validateCellPhone ($numero) {
        $numero = preg_replace("/[^0-9]/", "", $numero);
        if (strlen($numero) == 11 && substr($numero, 0, 1) == '9') {
            return true;
        } else {
            return false;
        }
    }

    public static function validateCPF($cpf) {
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
    
        if (strlen($cpf) != 11) {
            return false;
        }
    
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += intval($cpf[$i]) * (10 - $i);
        }
        $resto = $soma % 11;
        $dv1 = ($resto < 2) ? 0 : 11 - $resto;
    
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += intval($cpf[$i]) * (11 - $i);
        }
        $resto = $soma % 11;
        $dv2 = ($resto < 2) ? 0 : 11 - $resto;
    
        if ($dv1 == $cpf[9] && $dv2 == $cpf[10]) {
            return true;
        } else {
            return false;
        }
    }
    

}