<?php
require_once __DIR__ . "/../../class/metodosPagamento.php";

$metodos = metodosPagamento::select();

foreach ($metodos as $metodo){
    echo "<div class='borda-cinza '></div><!-- BORDA--><div class='btn-carrinho-white col-12' id='btn-metodo-".$metodo->id."' onclick='clickPagueSite(".$metodo->id.")'><input type='hidden' name='nome-metodo-".$metodo->id."' id='nome-metodo-".$metodo->id."' value='".$metodo->nome."'><input type='hidden' name='icone-metodo-".$metodo->id."' id='icone-metodo-".$metodo->id."' value='".$metodo->icone."'><div class='row px-3 pt-3 my-2'><div class='col-8 col-sm-5 px-0'><div class='font-weight-light '>".$metodo->nome."</div><div class='text-muted font-weight-light' id='cartao-atual'></div></div><div class='col-4 col-sm-7 px-0 text-right div-trocar '><div style='margin-top: 10px'><div class='text-danger position-relative btn font-weight-light d-inline-block btn-carrinho-white' id='btn-add-cartao' style='top: -10px;'>".$metodo->icone."</div></div></div></div></div>";
}

?>

