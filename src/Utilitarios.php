<?php
namespace Microblog;
abstract class Utilitarios {

    public static function dump($dados) {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }

    public static function formataData(string $dados) {
        return date("d/m/Y H:i", strtotime($dados));
    }

    // @autor: Marcelo - limitador de Caracteres
    public static function limitaCaracter($dados) {
        return mb_strimwidth($dados, 0, 20, " ...");
    }

}

// 11 960842377