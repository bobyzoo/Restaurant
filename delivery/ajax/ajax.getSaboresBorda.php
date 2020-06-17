<?php
require_once __DIR__ . "/../../class/sabores.php";

$sabores = new sabores();
$sabores = $sabores->selectBordas();

echo "<option value=''>Sem Borda</option>";
$group = '';
foreach ($sabores as $sabor) {
    if ($sabor->cat_sabores != $group) {
        $group = $sabor->cat_sabores;
        echo "<optgroup label='" . $group . "'>";
    }
    echo "<option value='" . $sabor->id . "'>" . $sabor->nome . " ------ R$ ".$sabor->valor."</option>";
}