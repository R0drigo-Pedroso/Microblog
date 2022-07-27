<?php

namespace Microblog;

final class ControleDeAcesso {
    public function __construct(){

        // Se NÃO EXISTE uma sessão em funcionamento
        if(!isset($_SESSION)){

            // Então iniciamos a sessão
            session_start();
        }
    }

    /**/
    public function verificaAcesso():void{
        
        /*Se NÃO EXISTE uma variavel de sessão relacionado ao id do usuario logado*/
        if(!isset($_SESSION['id'])){

            /*Então significa que o usuario não está logado, portanto apague qualquer resquicio de sessão e force o usuario a ir para login.php*/
            session_destroy();
            header('Location:../login.php?Acesso_proibido');
            die();
        }
    }
}


