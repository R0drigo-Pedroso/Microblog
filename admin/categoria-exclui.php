<?php
use Microblog\Categorias;
use Microblog\ControleDeAcesso;
require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso();
$sessao->verificaAcesso();

$categorias = new Categorias();
$categorias->setId($_GET['id']);
$categorias->excluirCategorias();
header('location:categorias.php');