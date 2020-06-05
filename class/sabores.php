<?php

require_once __DIR__."/conexao.php";
require_once __DIR__."/../lib/php/personalize-functions.php";

class sabores
{

    public function select($post)
    {
        $sql = "SELECT * FROM sabores";
        $stmt = Conexao::getInstance()->prepare($sql);
        $sabores = [];
        if ($stmt->execute()) {
            while ($linha = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($sabores,$linha);
            }
            return $sabores;
        } else {
            return "0;Problema de conexão!";
        }
    }

}