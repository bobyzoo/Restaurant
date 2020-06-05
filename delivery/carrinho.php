<?php require_once __DIR__ . "/header.php" ?>

<div class="container mt-5 ba">
    <form method="post" action="ajax/ajax.setItemPedido.php" class="mb-5 needs-validation" id="FrmCarrinho">
        <!--    --><?php
        //    foreach ($_SESSION['carrinho'] as $item){
        //        echo '<pre>';
        //        print_r($item);
        //        echo '</pre>';
        //
        //        echo "
        //
        //        ";
        //    }
        //    ?>
        <div class='container bg-white'>
            <div class="float-right">R$ x.xx</div>
            <div>Pizza de x fatias</div>
            <div class="font-weight-bold">Sabores:</div>
            <div>teste</div>
        </div>
    </form>
</div>
<script>
    $("#FrmItemPedido").submit(function (e) {
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
                    popover_notice('Item Inserido com Sucesso', 'success', 'topright');
                } else {
                    popover_notice('Erro ao inserir item', 'danger', 'topright');
                }
            }
        });
    });
</script>