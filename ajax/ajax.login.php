<?php
//session_start();
require_once "../class/usuarios.php";
$post = new stdClass;

foreach ($_POST as $key => $value) {
    $post->$key = $value;
}
$usuario = new usuarios();
echo $usuario->login($post);