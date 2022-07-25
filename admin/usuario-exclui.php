<?php 

require_once "../vendor/autoload.php";

use Microblog\Usuarios;

$usuario = new Usuario;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

excluirUsuario($conexao, $id);

header('Location:usuarios.php');
