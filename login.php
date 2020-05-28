<?php require_once "header.php"; ?>
<div class="text-center">
    <form class="form-signin">
        <div class="row">
            <div class="icon-pizza col-12"><i class="fad fa-pizza-slice display-1"></i></div>
        </div>
        <h1 class="h3 mb-3 font-weight-normal mt-2">
            Por favor, faça login</h1>
        <label for="inputEmail" class="sr-only">
            Endereço de e-mail</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Endereço de e-mail" required=""
               autofocus="">
        <label for="inputPassword" class="sr-only">
            Senha</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required="">
        <div class="mt-3">
        <button class="btn btn-lg btn-warning btn " type="submit">Cadastrar-se</button>
        <button class="btn btn-lg btn-primary  " type="submit">Entrar</button>
        </div>
    </form>
</div>
</body>
