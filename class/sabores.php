<?php

require_once __DIR__ . "/conexao.php";
require_once __DIR__ . "/../lib/php/personalize-functions.php";

class sabores
{

    public function select($post)
    {
        if ($post->pedaco == 4) {
            $preco = "pre_1";
        } elseif ($post->pedaco == 6) {
            $preco = "pre_2";
        } elseif ($post->pedaco == 8) {
            $preco = "pre_3";
        } else {
            $preco = "pre_4";
        }
        $sql = "SELECT sabores.nome as nome_sabores,sabores.id as id_sabor, cs.* FROM sabores LEFT JOIN cat_sabores cs on sabores.categoria_sabores = cs.id WHERE " .$preco." <> 0 ORDER BY cs.id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $sabores = [];
        if ($stmt->execute()) {
            while ($linha = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($sabores, $linha);
            }
            return $sabores;
        } else {
            return "0;Problema de conexão!";
        }
    }

    public function selectBordas(){
        $sql = "SELECT * FROM sabores_bordas ORDER BY cat_sabores";
        $stmt = Conexao::getInstance()->prepare($sql);
        $sabores = [];
        if ($stmt->execute()) {
            while ($linha = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($sabores, $linha);
            }
            return $sabores;
        } else {
            return "0;Problema de conexão!";
        }
    }


    public static function getValorBordaById($id){
        $sql = "SELECT valor FROM sabores_bordas where id = :id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $sabor = $stmt->fetch(PDO::FETCH_OBJ);
            return $sabor->valor;

        } else {
            return "0;Problema de conexão!";
        }
    }

    public static function getValorSaborById($id,$pedaco){
        $sql = "SELECT * FROM sabores LEFT JOIN cat_sabores ON cat_sabores.id = categoria_sabores where sabores.id = :id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $sabor = $stmt->fetch(PDO::FETCH_OBJ);
            return $sabor->$pedaco;

        } else {
            return "0;Problema de conexão!";
        }
    }

    public static function getSabor($id)
    {
        $sql = "SELECT * FROM sabores where id = :id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $sabor = $stmt->fetch(PDO::FETCH_OBJ);
            return $sabor->nome;

        } else {
            return "0;Problema de conexão!";
        }
    }
    public static function getSaborBorda($id)
    {
        $sql = "SELECT * FROM sabores_bordas where id = :id";
        $stmt = Conexao::getInstance()->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $sabor = $stmt->fetch(PDO::FETCH_OBJ);
            return $sabor->nome;

        } else {
            return "0;Problema de conexão!";
        }
    }
}