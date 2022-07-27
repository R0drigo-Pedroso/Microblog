<?php

namespace Microblog;
use PDO, Exception;

final class Usuario {
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo;
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    // Listar usuarios
    public function lista():array {
        $sql = "SELECT id, nome, email, tipo FROM usuarios ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $erro) {
            echo $erro->getMessage();
        }

        return $resultado;
    }
    // Final listar usuarios
    
    // Inserir Usuario
    public function inserir () {
        $sql = "INSERT INTO usuarios(nome, email, senha, tipo) 
        VALUES(:nome, :email, :senha, :tipo)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindParam(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->execute();

        } catch (Exception $erro) {
            echo ("Erro" .$erro->getMessage());
        }
    }
    // Final Inserir Usuarios
    
    // Usuario
    public function listarUm():array {
        $sql = "SELECT * FROM usuarios WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_STR);
            $consulta->execute();

            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die ("Erro: ". $erro->getMessage());
        }

        return $resultado;
    }
    // Final usuarios

    // Codificar senha
    public function codificaSenha(string $senha):string {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    // Verificar senha
    public function verificaSenha(string $senhaFormulario, string $senhaBanco):string {
        
        /* Usamos a password_verify para COMPARAR as duas senhas: a digitada no formulario e a existente no banco */
        if (password_verify($senhaFormulario, $senhaBanco)) {

            /* Se forem iguais, mantemos a senha existente no banco */
            return $senhaBanco;
        } else {

            /* se forem diferentes, então codificamos esta nova senha */
            return $this->codificaSenha($senhaFormulario);
        }
    }
    // Final Verificar senha
    // final codificar senha

    // Atualizar Usuarios para Troca Nome, email, e opções
    public function atualizar():void {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindParam(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();

        } catch (Exception $erro) {
            die ("Erro: ". $erro->getMessage());
        }
    }
    // Final Atualizar Usuarios para Troca Nome, email, e opções

    // Getters e Setters
    // E sanitizar os sets
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

    
    public function getEmail(): string
    {
        return $this->email;
    }

    
    public function setEmail(string $email): self
    {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);

        return $this;
    }

    
    public function getSenha(): string
    {
        return $this->senha;
    }

   
    public function setSenha(string $senha): self
    {
        $this->senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    
    public function getTipo(): string
    {
        return $this->tipo;
    }

    
    public function setTipo(string $tipo): self
    {
        $this->tipo = filter_var($tipo, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


// Excluir um Fabricante
function excluirUsuario():void {
    $sql = "DELETE FROM usuarios WHERE id = :id";

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta ->bindParam("id", $this->id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die ("Erro: " .$erro -> getMessage());
    }

}

}