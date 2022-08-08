<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$noticia = new Noticia;

/* Capturando o ID e o TIPO do Usuário logado e associando estes valores às propriedades do objeto usuário*/
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);
$listDeNoticias = $noticia->listar();

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Notícias <span class="badge bg-dark"><?=count($listDeNoticias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>

						<?php 
						if ($_SESSION['tipo'] =='admin') {
						?>
							<th>Autor</th>
						<?php }?>

						<th>Destaque</th>
		
						
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>

				<?php foreach ($listDeNoticias as $noticia) { ?>
					<tr>
                        <td> <?=$noticia['titulo']?> </td>
                        <td> <?=Utilitarios::formataData($noticia['data'])?></td>
						

						<!-- <td> <?=$noticia['autor'] ?? "Equipe MicroBlog" ?>
							Operado de Coalescência nula: Na prática, o valor à esquerda é exibido (desde que ele exista), caso cantrário o valor à direita é exibido.
						</td> -->

						<?php
							if ($_SESSION['tipo'] == 'admin') { ?>
								
								<?php	if ($noticia['autor'])  { ?>

									<td><?=$noticia['autor']?></td>
							
								<?php } else { ?>
									<td>Equipe MicroBlog</td>
								<?php } ?>
						<?php	} ?>
						

						<td> <?=$noticia['destaque']?></td>

						
						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
				<?php }	?>

				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

