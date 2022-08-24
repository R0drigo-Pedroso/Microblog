<?php
namespace Microblog;
use PDO, Exception;

abstract class Banco {
    private static string $servidor = "localhost";
    private static string $usuario = "suniow89_rodrigo";
    private static string $senha = "Rp582700+";
    private static string $banco = "suniow89_microblog_rodrigo";
    private static PDO $conexao; 

    public static function conecta():PDO {
        try {
            self::$conexao = new PDO(
                "mysql:host=".self::$servidor."; 
                dbname=".self::$banco.";
                charset=utf8",
                self::$usuario, 
                self::$senha
            );
            self::$conexao->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo "Ok!"; // teste
        } catch (Exception $erro) {
            die("Deu ruim: ".$erro->getMessage());
        }
        return self::$conexao;
    }
}
// Banco::conecta(); // teste