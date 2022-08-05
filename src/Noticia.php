<?php
namespace Microblog;
use PDO, Exception;

final class Noticia {
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private int $categoriaId;

    /* Crianado uma propriedade do tipo usuario, ou seja, apartir de uma class que criando com objetivo de reutilizar recusos dela
    Isso permitirá fazer uma ASSOCIAÇÃO entre Classes.
    */
    public usuario $usuario;


    private PDO $conexao;


    public function __construct() {

        /* No momento em que o um objeto Noticia for instanciado nas páginas, 
        aproveitaremos para também instaciar um objeto Usuario e com isso acessar recursos desta classe*/
        $this->usuario = new Usuario;

        /* Reaproveitando a conexao já existente a partir da classe de Usuario */
        $this->conexao = $this->usuario->getConexao();
    }

    public function inserir():void {
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, destaque, usuario_id, categoria_id) VALUES(:titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :categoria_id)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindParam(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindParam(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(":destaque", $this->destaque, PDO::PARAM_STR);
            
            /* Aqui, primeiro chamamos o getters de ID a partir do objeto/classe de Usuario. E só depois atribuimos ele ao parâmetro :usuario_id usando para isso o bindValue. 
            Obs: bindParam pode ser usado, mas há riscos de erro devido a forma como ele é executado pelo PHP. por isso, recomenda-se o uso do bindValue em situações como essa. */
            $consulta->bindValue(":categoria_id", $this->categoriaId, PDO::PARAM_INT);
                        
            $consulta->bindParam(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // fazendo uploud de imagem
    public function upload(array $arquivo) {
            
        // definindo os formatos aceitos
        $tiposValidos = [
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/svg+xml"
        ];

        if(!in_array($arquivo['type'], $tiposValidos)){
            exit("  <script>
                        alert('Formato de arquivo inválido');
                        history.back();
                    </script>");
            } 

        // Acessar apenas nome do arquivo
        $nome = $arquivo['name'];

        // Acessando os dados de acesso temporário do arquivo
        $temporario = $arquivo['tmp_name'];

        // Definindo a pasta de destino junto com nome do arquivo
        $destino = "../imagem/".$nome;

        // Usamos a função abaixo para pegar da área temporiária e enviar para a pasta de destino (com o nome do arquivo)
        move_uploaded_file($temporario, $destino);

    }

    public function listar():array {

        /* Se o tipo de usuario for admin  */
        if($this->usuario->getTipo() == 'admin'){
        
            /* Então ele poderá acessar as noticias de todos */
            $sql = "";
        }else{

            /*Senão (ou seja, é um editor), este usuário (editor) poderá aessar SOMENTE suas próprias noticias */

            $sql = "";
        }
    }

    

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        return $this;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }


    public function setTitulo(string $titulo): self
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    public function getResumo(): string
    {
        return $this->resumo;
    }

    public function setResumo(string $resumo): self
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem): self
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    public function getDestaque(): string
    {
        return $this->destaque;
    }

    public function setDestaque(string $destaque): self
    {
        $this->destaque = $destaque;
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): self
    {
        $this->categoriaId = filter_var($categoriaId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
}