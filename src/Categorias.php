<?php
namespace Microblog;
use PDO, Exception;
final class Categorias {
    private int $id;
    private string $nome;


    public function __construct() {
        $this->conexao = Banco::conecta();
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

    public function getNome(): string
    {
        return $this->nome;
    }

    
    public function setNome(string $nome): self
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


    // Divisão Comentario!

    // Inserir Categoria
    public function inserir () {
        $sql = "INSERT INTO categorias(nome) VALUES(:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();

        } catch (Exception $erro) {
            echo ("Erro" .$erro->getMessage());
        }
    }
    // Final Inserir Categorias

// Listar categorias
public function lista():array {
    $sql = "SELECT id, nome FROM categorias ORDER BY nome";

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $erro) {
        echo $erro->getMessage();
    }

    return $resultado;
}
// Final listar Categorias

// Excluir um Categorias
function excluirCategorias():void {
    $sql = "DELETE FROM categorias WHERE id = :id";

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta ->bindParam("id", $this->id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die ("Erro: " .$erro -> getMessage());
    }
}
// Final excluir Categorias

}