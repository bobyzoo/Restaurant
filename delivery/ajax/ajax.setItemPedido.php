<?php
session_start();
$post = new stdClass;
foreach ($_POST as $key => $value) {
    $post->$key = $value;
}


array_push($_SESSION['carrinho'],$post);

echo '1;';