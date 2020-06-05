<?php
require_once __DIR__."/../../class/sabores.php";

$post = new stdClass;
foreach ($_POST as $key => $value){
    $post->$key = $value;
}
$sabores = new sabores();
$sabores = $sabores->select($post);

echo "<option value=''>...</option>";
foreach ($sabores as $sabor){
    echo "<option value='".$sabor->id."'>".$sabor->nome."</option>";
}