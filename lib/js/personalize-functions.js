function popover_notice(text, color, position) {
    bs4pop.notice(text, //mensage
        {
            type: color, //primary, secondary, success, danger, warning, info, light, dark
            position: position, //topleft, topcenter, topright, bottomleft, bottomcenter, bottonright, center,
            appendType: 'append',
            closeBtn: 'true',
            className: ''
        });
}


function some_div_id(id) {
    $("#" + id).addClass("d-none");
    $("#" + id).removeClass("d-block");
}

function habilita_div_id(id) {
    $("#" + id).addClass("d-block");
    $("#" + id).removeClass("d-none");
}

function some_div_class(classe) {
    $("." + classe).addClass("d-none");
    $("." + classe).removeClass("d-block");
}

function habilita_div_class(classe) {
    $("." + classe).addClass("d-block");
    $("." + classe).removeClass("d-none");
}

function invalidaInput(id) {
    $("#" + id).addClass("is-invalid");
}

function animaDiv() {
    new WOW({
        mobile: true,
        offset: 500
    }).init();
}

function validaCPF(cpf) {
    console.log(cpf);
    cpf = cpf.replace("-", "");
    cpf = cpf.replace(".", "");
    cpf = cpf.replace(".", "");
    console.log(cpf);
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais) {
        numeros = cpf.substring(0, 9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        numeros = cpf.substring(0, 10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        return true;
    } else
        return false;
}

function onlynumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /^[0-9,.]+$/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function disableInputId(id) {
    $("#" + id).attr("disabled", true);
}

function ableInputId(id) {
    $("#" + id).removeAttr("disabled", true);
}


function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;

}

function defineMovimento(id,move) {
    $("#"+id).css("animation-name",move);
}