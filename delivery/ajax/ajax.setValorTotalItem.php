<?php
require_once __DIR__ . "/../../class/sabores.php";

$post = new stdClass;
foreach ($_POST as $key => $value) {
    $post->$key = $value;
}

if ($post->pedacos == 4) {
    $preco = "pre_1";
} elseif ($post->pedacos == 6) {
    $preco = "pre_2";
} elseif ($post->pedacos == 8) {
    $preco = "pre_3";
} else {
    $preco = "pre_4";
}
$valorTotal = 0;
$maiorValor = 0;
if (isset($post->valor_borda) && $post->valor_borda != null) {
    $valorTotal += sabores::getValorBordaById($post->valor_borda);
}

if (isset($post->valor_sabor1) && ($post->valor_sabor1) > 0) {
    $valor1 = sabores::getValorSaborById($post->valor_sabor1, $preco);
    if ($maiorValor < $valor1) {
        $maiorValor = $valor1;
    }
}
if (isset($post->valor_sabor2) && ($post->valor_sabor2) > 0) {
    $valor2 = sabores::getValorSaborById($post->valor_sabor2, $preco);
    if ($maiorValor < $valor2) {
        $maiorValor = $valor2;
    }
}
if (isset($post->valor_sabor3) && ($post->valor_sabor3) > 0) {
    $valor3 = sabores::getValorSaborById($post->valor_sabor3, $preco);
    if ($maiorValor < $valor3) {
        $maiorValor = $valor3;
    }
}


echo number_format($maiorValor + $valorTotal, 2, ",", ".");
