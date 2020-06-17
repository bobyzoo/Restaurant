<?php

require_once __DIR__ . "/conexao.php";
require_once __DIR__ . "/../lib/php/personalize-functions.php";

class metodosPagamento
{

    public static function select()
    {
        $sql = "SELECT * FROM metodos_pagamento";
        $stmt = Conexao::getInstance()->prepare($sql);
        $metodos = [];
        if ($stmt->execute()) {
            while ($linha = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($metodos, $linha);
            }
            return $metodos;
        } else {
            return "0;Problema de conexão!";
        }
    }

//
//    public static function getSabor($id)
//    {
//        $sql = "SELECT * FROM sabores where id = :id";
//        $stmt = Conexao::getInstance()->prepare($sql);
//        $stmt->bindParam(":id", $id);
//        if ($stmt->execute()) {
//            $sabor = $stmt->fetch(PDO::FETCH_OBJ);
//            return $sabor->nome;
//
//        } else {
//            return "0;Problema de conexão!";
//        }
//    }
}