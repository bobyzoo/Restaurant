<?php

require_once __DIR__ . "/conexao.php";
require_once __DIR__ . "/../lib/php/personalize-functions.php";

class sabores
{

    public function select($post)
    {
        $sql = "SELECT * FROM sabores";
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
}