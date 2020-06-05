<?php require_once "header.php"; ?>
<div class="text-center">
    <form class="form-signin" id="frmLogin" action="ajax/ajax.login.php" method="post">
        <div class="row">
            <div class="icon-pizza col-12"><i class="fad fa-pizza-slice display-1"></i></div>
        </div>
        <h1 class="h3 mb-3 font-weight-normal mt-2">
            Por favor, faça login</h1>
        <label for="inputEmail" class="sr-only">
            Endereço de e-mail</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Endereço de e-mail" required=""
               autofocus="">
        <label for="inputPassword" class="sr-only">
            Senha</label>
        <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" required="">
        <div class="mt-3">
        <button class="btn btn-lg btn-warning btn" type="button" href="cadastrar.php"><a href="cadastrar.php" style="text-decoration: none; color: white">Cadastrar-se</a></button>
        <button class="btn btn-lg btn-primary" type="submit">Entrar</button>
        </div>
    </form>
</div>
</body>

<script>
    $("#frmLogin").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                var data = data.split(';');
                if (data[0] === '1') {
                    popover_notice('Login confirmado', 'success', 'topright');
                    setTimeout(function () {
                        window.location.href = "delivery/index.php";
                    }, 3000);
                } else {
                    popover_notice('Erro ao fazer login', 'danger', 'topright');
                }
            }
        });
    });
</script>
