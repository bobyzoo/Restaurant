<?php

require_once "conexao.php";

class usuarios
{

    public function insert($post){
        $sql = "INSERT INTO usuarios (`email`, `senha`, `nome`, `id_cidade`, `id_bairro`, `numero`, `endereco`) VALUES (:email,:senha,:nome,:cidade,:bairro,:numero,:endereco)";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":email",$post->email);
        $stmt->bindParam(":senha",$post->senha);
        $stmt->bindParam(":nome",$post->nome);
        $stmt->bindParam(":cidade",$post->cidade);
        $stmt->bindParam(":bairro",$post->bairro);
        $stmt->bindParam(":numero",$post->numero);
        $stmt->bindParam(":endereco",$post->endereco);
        if ($stmt->execute()){
            return "1;";
        }else{
            return "0;";
        }
    }


}