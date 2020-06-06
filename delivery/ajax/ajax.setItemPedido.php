<?php
session_start();
$post = new stdClass;
foreach ($_POST as $key => $value) {
    $post->$key = $value;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}
array_push($_SESSION['carrinho'], $post);

echo '1;';