<?php require_once "header.php"; ?>
<style>
    body{
        background-color: #EBE4C4;
    }
</style>
<div class="container div-principal">
    <div class="py-5 text-center ">
        <div class="row">
            <div class="icon-pizza col-12"><i class="fad fa-pizza-slice display-1"></i></div>
        </div>
    </div>
    <div class="row ">
        <div class="col-12">
            <h4 class="mb-3">Endereço de cobrança</h4>
            <form class="needs-validation" method="post" action="ajax/ajax.cadatrar.php" id="FrmCadastro">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Nome completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="" value=""
                               required="">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="" value=""
                               required="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">E-mail </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="country">Cidade</label>
                        <select class="custom-select d-block w-100" id="cidade" name="cidade" required="">
                            <option value="">Escolher...</option>
                            <option value="2">Florianopolis</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="country">Bairro</label>
                        <select class="custom-select d-block w-100" id="bairro" name="bairro" required="">
                            <option value="">Escolher...</option>
                            <option value="1">Carianos</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="address">Numero</label>
                        <input type="text" class="form-control" id="numero" name="numero" placeholder="123" required=""
                               onkeyup="somenteNumeros(this);">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua x"
                           required="">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar
                </button>
            </form>
        </div>

    </div>
    <footer class="my-5 pt-5 text-dark text-center text-small">
        <p class="mb-1 ">© 2017-2018 Nome da empresa</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacidade</a></li>
            <li class="list-inline-item"><a href="#">Termos e Condições</a></li>
            <li class="list-inline-item"><a href="#">Apoio, suporte</a></li>
        </ul>
    </footer>
</div>
<script>

    $("#FrmCadastro").submit(function (e) {
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
                    popover_notice('Cadastro confirmado', 'success', 'topright');
                } else {
                    popover_notice('Erro ao cadastrar', 'danger', 'topright');
                }
            }
        });
    });

    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
            campo.value = "";
        }
    }

    // function setBoxSuccess(dvID, texto, dropDown, resetForm){
    //
    //     $("#" + dvID).html("<div class='alert alert-success fade in' id='boxSuccess'><i class='fa-fw fa fa-check'></i><strong>+'Sucesso'+</strong> " + texto + '</div>');
    //
    //     if (dropDown){
    //         $("#" + dvID).slideDown("fast");
    //     }
    //
    //     setTimeout(function(){
    //         $("#" + dvID).slideUp("fast");
    //     }, 5000);
    //
    //     if(resetForm != ""){
    //         limpaFormulario(resetForm);
    //     }
    // }

</script>
</body>
