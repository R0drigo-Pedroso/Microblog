<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

$noticia = new Noticia;
$noticia->setDestaque('sim');
$destaques = $noticia->listarDestaques();

$todas = $noticia->listarTodas();

?>


<div class="row my-1 mx-md-n1">

        <?php foreach ($destaques as $destaque) { ?>
            <!-- INÍCIO Card -->
            <div class="col-md-6 my-1 px-md-1">
                <article class="card shadow-sm h-100">
                    <a href="noticia.php?id=<?=$destaque['id']?>" class="card-link">
                        <img src="imagem/<?=$destaque['imagem']?>" alt="class="card-img-top" alt="Imagens do artigos">
                        <div class="card-body">
                            <h3 class="fs-4 card-title"><?=$destaque['titulo']?></h3>
                            <p class="card-text"><?=$destaque['resumo']?></p>
                        </div>
                    </a>
                </article>
            </div>
            <!-- FIM Card -->
        <?php } ?>
</div>        

        <?php include_once "inc/todas.php"; ?>


<?php 
require_once "inc/rodape.php";
?>

