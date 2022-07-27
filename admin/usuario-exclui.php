<?php 


require_once "../vendor/autoload.php";

use Microblog\ControleDeAcesso;
use Microblog\Usuario;

$sessao = new ControleDeAcesso();
$sessao->verificaAcesso();

// Instanciar o objeto Usuario = $usuario
$usuario = new Usuario; // Não esqueça do autoload e do namespace

// Instanciar o id da URL e o passamos para o setter = -> setId
$usuario ->setId($_GET['id']);

// Instanciar - só então executamos o método de exclusão
$usuario ->excluirUsuario();

// Após excluir, redireonamos para a página de lista de usuarios
header('Location:usuarios.php');
