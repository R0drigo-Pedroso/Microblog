<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

/* Mensagem de feedback relacionados ao acesso */
if(isset($_GET['acesso_proibido'])){
	$feedback = "Realize seu login primeiro!.";
} elseif(isset($_GET['campos_obrigatorios'])){
	$feedback = "É obrigatório o preenchimento dos campos nome e senha.";
} elseif(isset($_GET['nao_encontrado'])){
	$feedback = "Usuário não encontrado.";
}elseif(isset($_GET['senha_incorreta'])){
	$feedback = "Senha incorreta!.";
} elseif(isset($_GET['lougout'])){
	$feedback = "Você foi deslogado com sucesso.";
}

?>


<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

                <?php if(isset($feedback)){?>
				<p class="my-2 alert alert-warning text-center">
				<i class="bi bi-x-octagon-fill"></i> <?= $feedback ?>
				</p>
                <?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>
    </div>
    

<!-- Detectar -->
<?php
	if (isset($_POST['entrar'])){

		if(empty($_POST['email']) || empty($_POST['senha'])) {
			header("Location:login.php?campos_obrigatorios");
		} else {
			
			$usuario = new Usuario();
			$usuario ->setEmail ($_POST['email']);
			// Buscando um usuario no banco a partir do email
			$dados = $usuario ->buscar();
		
			/*  */
			if(!$dados){
				header("Location:login.php?nao_encontrado");
			}else{
				/* verificação da senha e login */
				if(password_verify($_POST['senha'], $dados['senha'])){
					$sessao = new ControleDeAcesso();
					$sessao ->login($dados['id'], $dados['nome'], $dados['tipo']);
					header("<Location:admin/index.php");
				} else {
					header("location:login.php?senha_incorreta");
				}
			}
		}
	}
?>

</div>        
        
        
    



<?php 
require_once "inc/rodape.php";
?>

