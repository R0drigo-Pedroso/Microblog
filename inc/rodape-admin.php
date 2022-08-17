    </div>
</main>

<footer class="footer mt-auto py-3 bg-dark border-top">
    <div class="container text-center text-white">
        Microblog é um site fictício desenvolvido para fins didáticos | Senac Penha &copy; 2022
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php 
switch($pagina){
    case 'usuarios.php':
    case 'noticias.php':
    case 'categorias.php':
?>
<script src="js/confirm.js"></script>
<?php
    break;

    case 'noticia-insere.php':
    case 'noticia-atualiza.php':
?>
<script src="js/contador.js"></script>
<?php
    break;
}
?>
</body>
</html>
<?php
    /* Finaizando o monitoramento do buffer de saida (área na memória em que headers são processados) */
    ob_end_flush();
?>