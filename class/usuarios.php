<?php

require_once "conexao.php";
require_once "../lib/php/personalize-functions.php";

session_start();

class usuarios
{

    public function insert($post)
    {
        $sql = "INSERT INTO usuarios (`email`, `senha`, `nome`, `id_cidade`, `id_bairro`, `numero`, `endereco`) VALUES (:email,:senha,:nome,:cidade,:bairro,:numero,:endereco)";
        $stmt = Conexao::getInstance()->prepare($sql);
        $email = md5($post->email);
        $senha = md5($post->senha);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":nome", $post->nome);
        $stmt->bindParam(":cidade", $post->cidade);
        $stmt->bindParam(":bairro", $post->bairro);
        $stmt->bindParam(":numero", $post->numero);
        $stmt->bindParam(":endereco", $post->endereco);
        if ($stmt->execute()) {
            return "1;";
        } else {
            return "0;";
        }
    }

    public function login($post)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $stmt = Conexao::getInstance()->prepare($sql);
        $email = md5($post->email);
        $senha = md5($post->senha);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $_SESSION['usuario'] = $email;
                $_SESSION['senha'] = $senha;
                return "1;Login com sucesso!";
            } else {
                return "0;Email ou senha estão incorretos!";
            }
        } else {
            return "0;Problema de conexão!";
        }
    }

}