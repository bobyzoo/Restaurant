<?php require_once __DIR__ . "/header.php";
require_once __DIR__ . "/../class/sabores.php";
//echo '<pre>';
//print_r($_SESSION['carrinho']);
//echo '</pre>';
//$_SESSION['carrinho'][7] = $_SESSION['carrinho'][8];
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
            <div class="container px-3 mb-3 pb-2  borda-cinza">
                <div class='float-right font-weight-bold'>R$ <?= $valor ?> </div>
                <div>SubTotal</div>
            </div>
            <div>
                <div class="container px-3 mb-3 pb-2 ">
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
                    <div class="text-muted font-weight-light" id="cartao-atual"></div>
                </div>
                <div class="col-4 col-sm-7 px-0 text-right div-trocar">
                    <div style="margin-top: 10px">
                        <div id="bandeira-cartao">
                        </div>
                        <div class="text-danger position-relative btn font-weight-light d-inline-block btn-carrinho-white"
                             id="btn-add-cartao" style="top: -15px;">Adicionar
                        </div>
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
                        <div class="text-danger btn font-weight-light position-relative d-inline-block btn-carrinho-white"
                             id="trocarCpf" style="top: -15px;">
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


    <!--    METODO DE PAGAMENTO-->
    <div class="pt-3 pb-1 fundo-desfoque fadeInRight wow d-none" id="div-metodo-pagamento" data-wow-offset="100"
         data-wow-duration='0.5s'>
        <div class="form-group bg-white py-3">
            <div class="container">
                <div class="row ml-1">
                    <div class="position-relative text-danger btn font-weight-light d-inline-block text-center btn-carrinho-white"
                         style="padding-left: 10px; top: 0" id="btn-mp-carrinho"><i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="col-12 text-center d-inline-block mb-4">FORMAS DE PAGAMENTO</div>
                    <div class="col-12 text-center d-inline-block text-muted mb-3">Escolha um das opções aceitas por
                        este
                        estabelecimento
                    </div>
                </div>
            </div>
            <div class="container">
                <label class="text-dark col-12 borda-cinza" for="cpf_nota">
                    <h4 class="font-weight-bold">Pague pelo Site</h4>
                </label>
                <div class="row px-3 pt-3 my-2">
                    <div class="col-8 col-sm-5">
                        <div class="font-weight-light ">Cartão de Crédito/Débito</div>
                        <div class="text-muted font-weight-light" id="cartao-atual-t"></div>
                    </div>
                    <div class="col-4 col-sm-7 text-right div-trocar ">
                        <div style="margin-top: 10px">
                            <div class="text-danger position-relative btn font-weight-light d-inline-block btn-carrinho-white"
                                 id="btn-add-cartao-cc" style="top: -15px;"><i class="far fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="borda-cinza mb-5"></div><!-- BORDA-->
                <label class="text-dark col-12 " for="cpf_nota">
                    <h4 class="font-weight-bold">Pague na entrega</h4>
                </label>

                <!--                Lista de metodos de pagamento-->
                <div id="div-metodos-pagamento"></div>
            </div>
        </div>
    </div>

    <!--    ADD NOVO CARTÃO-->
    <div class="pt-3 pb-1 fundo-desfoque fadeInRight wow d-none" id="div-novo-cartao" data-wow-offset="50"
         data-wow-duration='0.5s'>
        <div class="form-group bg-white py-3">
            <div class="container">
                <div class="row ml-1">
                    <div class="position-relative text-danger btn font-weight-light d-inline-block text-center btn-carrinho-white"
                         style="padding-left: 10px; top: 0" id="btn-mp-carrinho"><i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="col-12 text-center d-inline-block mb-4">CARTÃO DE CRÉDITO/DÉBITO</div>
                    <div class="col-12 text-center d-inline-block text-muted mb-3">
                        Para utilizar débito, consulte as condições de uso.
                    </div>
                </div>
            </div>
            <div class="container form-group">
                <div class="row px-3 pt-3 my-2 ">
                    <div class="col-12">
                        <label for="numeroCartao" class="font-weight-light text-muted col-12">Número do cartão</label>
                        <input name="numeroCartao" id="numeroCartao" type="text"
                               class="form-group col-9 col-sm-11 borda-cinza border-top-0 border-left-0 border-right-0"
                               maxlength="16"
                               style="font-family: Arial,sans-serif; font-size: 20px">
                        <div class="d-inline-block ml-3">
                            <i class="fad fa-lock-alt text-muted"></i>
                        </div>
                    </div>
                </div>

                <div class="container form-group">
                    <div class="row px-3 pt-3 my-2 ">
                        <div class="col-6">
                            <label for="valCartao" class="font-weight-light text-muted">Validade</label>
                            <input type="text" id="valCartao" name="valCartao"
                                   class=" borda-cinza border-top-0 border-left-0 border-right-0 col-12 "
                                   style="font-family: Arial,sans-serif; font-size: 20px">
                            <div class="text-danger d-none  erro-cpf  mt-1" id="erro-valCart">
                                Data Inválida.
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="cvvCartao" class="font-weight-light text-muted d">CVV</label>
                            <input type="text" id="cvvCartao" name="cvvCartao"
                                   class="form-group  col-12 borda-cinza border-top-0 border-left-0 border-right-0"
                                   style="font-family: Arial,sans-serif; font-size: 20px;">
                        </div>
                    </div>
                </div>

                <div class="container form-group">
                    <div class="row px-3 pt-3 my-2 ">
                        <div class="col-12">
                            <label for="numeroCartao" class="font-weight-light text-muted">Nome do titular</label>
                            <input name="nomeTitular" id="nomeTitular" type="text"
                                   class="form-group col-12 borda-cinza border-top-0 border-left-0 border-right-0"
                                   style="font-family: Arial,sans-serif; font-size: 20px">
                        </div>
                    </div>
                </div>

                <div class="container form-group">
                    <div class="row px-3 pt-3 my-2 ">
                        <div class="col-12">
                            <label for="numeroCartao" class="font-weight-light text-muted">CPF/CNPJ</label>
                            <input name="cpf_cartao" id="cpf_cartao" type="text" onchange="verificaCheckCpf()"
                                   class="form-group campoCpfCnpj col-12 borda-cinza border-top-0 border-left-0 border-right-0"
                                   style="font-family: Arial,sans-serif; font-size: 20px">
                        </div>

                        <div class="text-danger d-none  erro-cpf  pl-3" id="erro-cpf">
                            Insira um número de CPF/CNPJ válido.
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mx-2">
                <div class="btn py-2 col-12 text-center btn-danger" id="salvarCpf" onclick="clickSalvarCpfCnpj()">
                    Salvar
                </div>
            </div>
        </div>
    </div>

    <!--    CPF NA NOTA-->
    <div class=" pt-3 pb-1 fundo-desfoque d-none fadeInRight wow" id="div-cpf" data-wow-offset="100"
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
                           style="font-family: Arial,sans-serif; font-size: 20px" disabled>
                </div>
                <div class="d-inline-block col-4 pr-5">
                    <label class="switch float-right mt-2">
                        <input type="checkbox" id="checkCpf" onchange="verificaCheckCpf()" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="text-danger d-none pl-3" id="erro-cpf">
                    Insira um número de CPF/CNPJ válido.
                </div>
            </div>
            <div class="row mx-2">
                <div class="btn py-2 col-12 text-center btn-danger" id="salvarCpf" onclick="clickSalvarCpfCnpj()">
                    Salvar
                </div>
            </div>
        </div>
    </div>


</div>
<script src="../lib/jQuery/jquery.mask.min.js"></script>
<script>

    // Adiciona mais item
    function addMaisItem() {
        window.location.href = "index.php";
    }


    //
    // Novo cartao de credito
    //

    var cartoes = {
        Visa: /^4[0-9]{12}(?:[0-9]{3})/,
        Mastercard: /^5[1-5][0-9]{14}/
    };

    $("#numeroCartao").mask("9999 9999 9999 9999");
    $("#valCartao").mask("99/99");
    $("#cvvCartao").mask("9999");

    $("#numeroCartao").focusout(function () {
        testarCC($("#numeroCartao").val(), cartoes)
    });
    var dataAtual = new Date();

    ano = String(dataAtual.getFullYear()).split("");
    anoReduzino = ano[2] + ano[3];
    mes = dataAtual.getMonth();


    $("#valCartao").focusout(function () {
        let valor_campo = $("#valCartao").val().split("");

        if (valor_campo.length != 5) {
            habilita_div_id("erro-valCart");
            console.log('2erro')
        } else {
            let ano_campo = valor_campo[3] + valor_campo[4];
            let mes_campo = valor_campo[0] + valor_campo[1];
            if ((parseInt(ano_campo) < parseInt(anoReduzino))  || mes_campo < mes) {
                console.log('1erro');
                habilita_div_id("erro-valCart")

            } else {
                console.log('3erro');
                some_div_id("erro-valCart")

            }
        }

    });

    function testarCC(nr, cartoes) {
        for (var cartao in cartoes) if (nr.match(cartoes[cartao])) return cartao;
        return false;
    }


    //
    //    METODO DE PAGAMENTO
    //
    //Click Adicionar/Trocar metodo de pagamento
    $("#btn-add-cartao").click(function () {
        defineMovimento("div-metodo-pagamento", "fadeInRight");
        defineMovimento("FrmCarrinho", "fadeOutLeft");
        animaDiv();
        setTimeout(function () {
            habilita_div_id("div-metodo-pagamento");
            some_div_id("FrmCarrinho");
        }, 500);
    });

    $("#btn-add-cartao-cc").click(function () {
        defineMovimento("div-novo-cartao", "fadeInRight");
        defineMovimento("div-metodo-pagamento", "fadeOutLeft");
        animaDiv();
        setTimeout(function () {
            habilita_div_id("div-novo-cartao");
            some_div_id("div-metodo-pagamento");
        }, 500);
    });

    //Recupera metodos de pagamento na entrega
    getMetodos();

    // Click em voltar para o carrinho
    $("#btn-mp-carrinho").click(function () {
        voltaMetodoPagamentoCarrinho();
    });

    function voltaMetodoPagamentoCarrinho() {
        defineMovimento("div-metodo-pagamento", "fadeOutRight");
        defineMovimento("FrmCarrinho", "fadeInLeft");
        animaDiv();
        setTimeout(function () {
            habilita_div_id("FrmCarrinho");
            some_div_id("div-metodo-pagamento");
        }, 500);
    }

    function clickPagueSite(id) {
        $("#cartao-atual").html($("#nome-metodo-" + id).val() + ' ' + $("#icone-metodo-" + id).val());
        $("#btn-add-cartao").html("Trocar");
        voltaMetodoPagamentoCarrinho();
    }

    function getMetodos() {
        $.ajax({
            url: "ajax/ajax.getMetodosPagamento.php",
            type: "POST",
            beforeSend: function () {
            },
            success: function (data) {
                $("#div-metodos-pagamento").html(data);
            }
        });
    }


    //
    //     CPF- CNPJ
    //

    //Click em salvar CPF/CNPJ
    function clickSalvarCpfCnpj() {
        if ($("#checkCpf").is(':checked')) {
            $("#cpfcnpj_atual").html("");
            $("#trocarCpf").html("Adicionar");
            $("#cpf_cnpj_nota").val("");
        } else {
            if (verificaCampoCpfCnpj()) {
                $("#cpfcnpj_atual").html($(".campoCpfCnpj").val());
                $("#trocarCpf").html("Trocar");
                $("#cpf_cnpj_nota").val($(".campoCpfCnpj").val());
            } else {
                return false
            }
        }

        defineMovimento("div-cpf", "fadeOutRight");
        defineMovimento("FrmCarrinho", "fadeInLeft");
        animaDiv();
        setTimeout(function () {
            habilita_div_id("FrmCarrinho");
            some_div_id("div-cpf");
        }, 500);
    }

    //Saiu do foco do input de cpf/cnpj
    $(".campoCpfCnpj").focusout(function () {
        verificaCampoCpfCnpj()
    });
    $("#cpf").focusout(function () {
        verificaCampoCpfCnpj()
    });

    //verifica campo cpf/cnpj
    function verificaCampoCpfCnpj() {
        let cpfcnpj = $(".campoCpfCnpj").val();
        if (cpfcnpj.length === 0) {
            return false
        }
        if (cpfcnpj.length > 14) {
            if (!validarCNPJ(cpfcnpj)) {
                habilita_div_class("erro-cpf");
                return false
            } else {
                some_div_class("erro-cpf");
                return true
            }
        } else {
            if (!validaCPF(cpfcnpj)) {
                habilita_div_class("erro-cpf");
                return false
            } else {
                some_div_class("erro-cpf");
                return true
            }
        }
    }

    //Click Adicionar/Trocar CPF/CNPJ
    $("#trocarCpf").click(function () {
        defineMovimento("div-cpf", "fadeInRight");
        defineMovimento("FrmCarrinho", "fadeOutLeft");
        animaDiv();
        setTimeout(function () {
            habilita_div_id("div-cpf");
            some_div_id("FrmCarrinho");
        }, 500);
    });

    //Verifica se check se tera cpf/cnpj ou nao
    function verificaCheckCpf() {
        if ($("#checkCpf").is(':checked')) {
            disableInputId("cpf_nota");
        } else {
            ableInputId("cpf_nota");
        }
    }

    //MASCARA CPF - CNPJ
    $(".campoCpfCnpj").keydown(function () {
        try {
            $(".campoCpfCnpj").unmask();
        } catch (e) {
        }

        var tamanho = $(".campoCpfCnpj").val().length;
        if (tamanho < 11) {
            $(".campoCpfCnpj").mask("999.999.999-99");
        } else {
            $(".campoCpfCnpj").mask("99.999.999/9999-99");
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
</script>