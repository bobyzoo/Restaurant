<?php require_once __DIR__ . "/header.php";
require_once __DIR__ . "/../class/sabores.php";
echo '<pre>';
echo '</pre>';
$_SESSION['carrinho'][7] = $_SESSION['carrinho'][0];
?>
<div class="container mt-5 ">
    <form method='post' action='ajax/ajax.setItemPedido.php' class='mb-5 needs-validation nota fadeOutLeft wow'
          id='FrmCarrinho' data-wow-offset="100" data-wow-duration='0.5s'>
        <div class='container bg-white pt-3 pb-1'>
            <?php
            $subTotal = 0;
            $html = '';
            foreach ($_SESSION['carrinho'] as $item) {
                $valor = 0.00;
                $html .= "<div class='container px-3 mb-3 pb-2 borda-cinza'><div class='float-right font-weight-bold'><h4>R$ " . $valor . "<div class='d-inline-block ml-3 btn btn-carrinho-white '><i class='text-danger fas fa-ellipsis-v'></i></div></div></h4><div class='font-weight-bold' style='color: #343A40'><p>Pizza de " . $item->numFatias . " fatias</p></div><div class='font-weight-bold'>Sabores:</div>";
                $subTotal += $valor;
                for ($c = 0; $c < 3; $c++) {
                    $sabor = 'sabor' . $c;
                    if (isset($item->$sabor) and $item->$sabor != null) {
                        $html .= "<div><li style='list-style: none'> - " . sabores::getSabor($item->$sabor) . "</li></div>";
                    }
                }
                if ($item->observacoes != null) {
                    $html .= '<div class="font-weight-bold">Observações:</div>';
                    $html .= '<div><li style="list-style: none"> - ' . $item->observacoes . '</li></div>';
                }
                $html .= '</div>';
            }
            $desconto = 0;
            echo $html;
            ?>
            <div class="container px-5 mb-3 pb-2 borda-cinza">
                <button type="button" class="btn col-12 col-md-4 offset-md-4 my-3 btn-danger text-white "
                        onclick="addMaisItem()">Adicionar mais itens
                </button>
            </div>
            <div class="container px-5 mb-3 pb-2 borda-cinza">
                <div class='float-right font-weight-bold'>R$ <?= $valor ?> </div>
                <div>SubTotal</div>
            </div>
            <div>
                <div class="container px-5">
                    <div class='float-right font-weight-bold text-muted'>- R$ <?= $subTotal ?> </div>
                    <div class="pt-1">Cumpom</div>
                    <div class='float-right font-weight-bold text-muted'>R$ <?= $desconto ?> </div>
                    <div class="pt-1 mb-3">Taxa de entrega</div>
                    <div class='float-right font-weight-bold'><h3>R$ <?= $subTotal - $desconto ?> </h3></div>
                    <div class="font-weight-bold "><h3>Total</h3></div>
                </div>
            </div>
        </div>
        <div class="container font-weight-bold  bg-white mt-2 mb-5 pt-3 pb-5">
            <div class="borda-cinza-2">
                <h3>Pagamento</h3>
            </div>
            <div class="row px-3 pt-3">
                <div class="col-8 col-sm-5 px-0">
                    <div class="font-weight-bold">Formas de pagamento</div>
                    <div class="text-muted font-weight-light">Crédito Mastercard</div>
                </div>
                <div class="col-4 col-sm-7 px-0 text-right div-trocar">
                    <div style="margin-top: 10px">
                        <i class="fab fa-cc-mastercard text-primary"></i>
                        <div class="text-danger btn font-weight-light d-inline-block btn-carrinho-white">Trocar</div>
                    </div>
                </div>
            </div>
            <div class="borda-cinza"></div><!-- BORDA-->
            <div class="row px-3 pt-3">
                <div class="col-8 col-sm-5 px-0">
                    <div class="font-weight-bold">CPF/CNPJ na nota</div>
                    <div class="text-muted font-weight-light" id="cpfcnpj_atual"></div>
                </div>
                <div class="col-4 col-sm-7 px-0 text-right div-trocar ">
                    <div style="margin-top: 10px">
                        <div class="text-danger btn font-weight-light d-inline-block btn-carrinho-white" id="trocarCpf">
                            Adicionar
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="cpf_cnpj_nota" name="cpf_cnpj_nota" value="">
        <div class="container  btn-fazer-pedido borda-cinza border-1 border-top">
            <div class="container bg-white col-12 py-2 py-3">
                <button class="btn btn-lg btn-danger col-12 col-md-8 offset-md-2">Fazer pedido</button>
            </div>
        </div>

    </form>

    <!--    CPF NA NOTA-->
    <div class="container pt-3 pb-1 fundo-desfoque d-none fadeInRight wow" id="div-cpf" data-wow-offset="100"
         data-wow-duration='0.5s'>
        <div class="form-group bg-white py-3">
            <div>
                <label class="text-muted col-12" for="cpf_nota">
                    CPF/CNPJ
                </label>
            </div>
            <div class="row ml-1">
                <div class="col-8 mb-1">
                    <input name="cpf_nota" id="cpf_nota" type="text" class="form-group col-12"
                           style="font-family: Arial,sans-serif; font-size: 20px">

                </div>
                <div class="d-inline-block col-4 pr-5">
                    <label class="switch float-right mt-2">
                        <input type="checkbox" id="checkCpf" onchange="verificaCheckCpf()">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="text-danger d-none pl-3" id="erro-cpf">
                    Insira um número de CPF/CNPJ válido.
                </div>
            </div>
            <div class="row mx-2">
                <div class="btn py-2 col-12 text-center btn-danger" id="salvarCpf">Salvar</div>
            </div>
        </div>
    </div>
</div>
<script src="../lib/jQuery/jquery.mask.min.js"></script>
<script>

    $("#cpf_nota").keydown(function () {
        try {
            $("#cpf_nota").unmask();
        } catch (e) {
        }

        var tamanho = $("#cpf_nota").val().length;
        if (tamanho < 11) {
            $("#cpf_nota").mask("999.999.999-99");
        } else {
            $("#cpf_nota").mask("99.999.999/9999-99");
        }

        // ajustando foco
        var elem = this;
        setTimeout(function () {
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    });

    function addMaisItem() {
        window.location.href = "index.php";
    }

    function verificaCheckCpf() {
        if ($("#checkCpf").is(':checked')) {
            disableInputId("cpf_nota");
        } else {
            ableInputId("cpf_nota");
        }
    }


    $("#salvarCpf").click(function () {
        if (verificaCampoCpfCnpj()) {
            if ($("#checkCpf").is(':checked')) {
                $("#cpfcnpj_atual").html("");
                $("#trocarCpf").html("Adicionar");
                $("#cpf_cnpj_nota").val("");
            } else {
                $("#cpfcnpj_atual").html($("#cpf_nota").val());
                $("#trocarCpf").html("Trocar");
                $("#cpf_cnpj_nota").val($("#cpf_nota").val());
            }

            defineMovimento("div-cpf", "fadeOutRight");
            defineMovimento("FrmCarrinho", "fadeInLeft");
            animaDiv();
            setTimeout(function () {
                habilita_div_id("FrmCarrinho");
                some_div_id("div-cpf");
            }, 500);
        }
    });

    $("#cpf_nota").focusout(function () {
        verificaCampoCpfCnpj()
    });

    function verificaCampoCpfCnpj() {
        let cpfcnpj = $("#cpf_nota").val();
        if (cpfcnpj.length > 14) {
            if (!validarCNPJ(cpfcnpj)) {
                habilita_div_id("erro-cpf");
                return false
            } else {
                some_div_id("erro-cpf");
                return true
            }
        } else {
            if (!validaCPF(cpfcnpj)) {
                habilita_div_id("erro-cpf");
                return false
            } else {
                some_div_id("erro-cpf");
                return true
            }
        }
    }

    $("#trocarCpf").click(function () {
        defineMovimento("div-cpf", "fadeInRight");
        defineMovimento("FrmCarrinho", "fadeOutLeft");
        animaDiv();
        setTimeout(function () {
            habilita_div_id("div-cpf");
            some_div_id("FrmCarrinho");
        }, 500);
    })
</script>