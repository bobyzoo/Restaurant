<?php require_once __DIR__ . "/header.php";
?>
<div class="container mt-5">
    <div class="font-weight-bold itens">
        Quantas fatias ?
    </div>
</div>
<form method="post" action="ajax/ajax.setItemPedido.php" class="mb-5 needs-validation" id="FrmItemPedido">
    <div class="container text-center mt-3">
        <div class="row">
            <div class="col-6 col-sm-2 offset-sm-1 col-md-3 offset-md-0 btn btn-pizza" onclick="escolhePizza(1,4)">
                <figure class="figure ">
                    <img src="../img/pizza-4.png" class="img-fluid" alt="Quatro fatias">
                    <figcaption class="figure-caption cap">4<br>1 sabor</figcaption>
                </figure>
            </div>
            <div class="col-6 col-sm-2 offset-sm-1 col-md-3 offset-md-0 btn-pizza" onclick="escolhePizza(2,6)">
                <figure class="figure">
                    <img src="../img/pizza-6.png" class="img-fluid" alt="Seis fatias">
                    <figcaption class="figure-caption cap">6<br>2 sabores</figcaption>
                </figure>
            </div>
            <div class="col-6 col-sm-2 offset-sm-1 col-md-3 offset-md-0 btn-pizza" onclick="escolhePizza(3,8)">
                <figure class="figure">
                    <img src="../img/pizza-8.png" class="img-fluid" alt="Oito fatias">
                    <figcaption class="figure-caption cap">8<br>3 sabores</figcaption>
                </figure>
            </div>
            <div class="col-6 col-sm-2 offset-sm-1 col-md-3 offset-md-0 btn-pizza" onclick="escolhePizza(3,12)">
                <figure class="figure">
                    <img src="../img/pizza-12.png" class="img-fluid" alt="Doze fatias">
                    <figcaption class="figure-caption cap">12<br>3 sabores</figcaption>
                </figure>
            </div>
        </div>
    </div>

    <!--    Quais os sabores-->
    <div class="container">
        <div id="sabores" class="mb-5">
        </div>
    </div>


    <!--    Qual borda-->
    <div class="container">
        <div id="sabores-borda" class="mb-5">
        </div>
    </div>


    <!--    Observação-->
    <div class="container">
        <div id="obs" class="mb-5 form-group d-none">
            <label for="TextArea" class="font-weight-bold">Observações: </label>
            <textarea class="form-control" id="TextArea" rows="5" maxlength="250"
                      placeholder="Máximo 250 caracteres" name="observacoes"></textarea>
        </div>
    </div>

    <input type="hidden" value="" id="numeroFatias" name="numFatias">
    <input type="hidden" value="" id="valorTotal" name="valorTotal">
    <div class="container mb-5">
        <div class="float-left d-none" id="valor-pizza"><h4>Valor da pizza: R$ <span id="valor">00,00</span></h4></div>
        <button class="btn btn-warning text-white rounded rounded-5 border-light float-right d-none mb-5 mt-5"
                type="submit"
                id="btn-carrinho">
            <i class="fas fa-plus-circle"></i> Adicionar ao carrinho
        </button>
        <div style="height: 20px"></div>
    </div>
</form>
<script>

    function escolhePizza(id, pedacos) {
        $('#conteudo-sabores').remove();
        $('#conteudo-sabores-borda').remove();
        $('#valor').html('00,00');
        let html = "<div id='conteudo-sabores'><div class='container mt-5' id=''><div class='font-weight-bold itens'>Quais sabores? </div></div>";
        html += "<div class='container form-group'><label class='col-11'><select onchange='atualizaValorTotal(" + pedacos + ")' name='sabor0' id='sabor0' class='form-control select-sabores' required='required'><option value=''>...</option></select></label></div>";
        for (let c = 1; c < id; c++) {
            html += "<div class='container form-group'><label class='col-11 '><select onchange='atualizaValorTotal(" + pedacos + ")'  name='sabor" + c + "' id='sabor" + c + "'  class='form-control select-sabores'><option value=''>...</option></select></label></div>";
        }


        $("#sabores").append(html);
        $("#sabores-borda").append("<div id='conteudo-sabores-borda'><div class='container mt-5' id='conteudo-sabores-borda'><div class='font-weight-bold itens'>Qual sabor da borda?</div></div><div class='container form-group'><label class='col-11'><select onchange='atualizaValorTotal(" + pedacos + ")'  name='sabor_borda' class='form-control' id='select-sabores-borda' required='required'><option value=''>...</option></select></label></div>");

        getSabores(pedacos);
        getSaboresBordas();
        habilitaBtn();
        habilitaObservacoes();
        $("#numeroFatias").val(pedacos);
    }

    function getSaboresBordas() {
        $.ajax({
            url: "ajax/ajax.getSaboresBorda.php",
            type: "POST",
            beforeSend: function () {
                $("#select-sabores-borda").attr("disabled", "disabled");
                $("#select-sabores-borda").html("<option value=''>carregando_aguarde</option>");

            },
            success: function (data) {
                $("#select-sabores-borda").html(data);
                $("#select-sabores-borda").removeAttr("disabled", "disabled");

            }
        });
    }

    function getSabores(pedaco) {
        $.ajax({
            url: "ajax/ajax.getSabores.php",
            data: {pedaco},
            type: "POST",
            beforeSend: function () {
                $(".select-sabores").attr("disabled", "disabled");
                $(".select-sabores").html("<option value=''>carregando_aguarde</option>");

            },
            success: function (data) {
                $(".select-sabores").html(data);
                $(".select-sabores").removeAttr("disabled", "disabled");

            }
        });
    }


    function atualizaValorTotal(pedacos) {
        let valor_borda = $("#select-sabores-borda").val();
        let valor_sabor1 = $("#sabor0").val();
        let valor_sabor2 = $("#sabor1").val();
        let valor_sabor3 = $("#sabor2").val();
        $.ajax({
            url: "ajax/ajax.setValorTotalItem.php",
            data: {valor_borda, valor_sabor1, valor_sabor2, valor_sabor3, pedacos},
            type: "POST",
            success: function (data) {
                $("#valorTotal").val(data)
                $("#valor").html(data);
            }
        });
    }


    function habilitaObservacoes() {
        $("#obs").addClass("d-block");
        $("#obs").removeClass("d-none");
    }

    function habilitaBtn() {
        $("#btn-carrinho").addClass("d-block");
        $("#valor-pizza").addClass("d-block");
        $("#valor-pizza").removeClass("d-none");
        $("#btn-carrinho").removeClass("d-none");
    }

    $("#FrmItemPedido").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                var data = data.split(';');
                if (data[0] === '1') {
                    popover_notice('Item Inserido com Sucesso', 'success', 'topright');
                    setTimeout(function () {
                        window.location.href = "carrinho.php";
                    }, 3000);
                } else {
                    popover_notice('Erro ao inserir item', 'danger', 'topright');
                }
            }
        });
    });
</script>