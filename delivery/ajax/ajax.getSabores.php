<?php
require_once __DIR__ . "/../../class/sabores.php";

$post = new stdClass;
foreach ($_POST as $key => $value) {
    $post->$key = $value;
}
$sabores = new sabores();
$sabores = $sabores->select($post);

if ($post->pedaco == 4) {
    $preco = "pre_1";
} elseif ($post->pedaco == 6) {
    $preco = "pre_2";
} elseif ($post->pedaco == 8) {
    $preco = "pre_3";
} else {
    $preco = "pre_4";
}

echo "<option value=''>...</option>";
$group = '';
foreach ($sabores as $sabor) {
    if ($sabor->nome != $group){
        $group = $sabor->nome;
        echo "<optgroup label='" . $group . "     R$ ".$sabor->$preco."'>" ;
    }
    echo "<option value='" . $sabor->id_sabor . "'>" . $sabor->nome_sabores . "</option>";
}