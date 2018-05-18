//fun��o-verifica-senha-no-campo-senha-confsenha
function ValidarSenha(input) {
    if (input.value !== document.getElementById('Senha').value) {
        input.setCustomValidity('Repita a senha corretamente');
    } else {
        input.setCustomValidity('');
    }
}

//fun��o-para-verificar-campo-vazio
function validaCampo() {
    if (document.cadastro.Nome.value === "")
    {
        alert("O Campo nome é obrigatório!");
        document.cadastro.Nome.focus();
        return false;
    }
    else
    if (document.cadastro.Sexo.value === "")
    {
        alert("Opção Sexo Desmarcada!");
        return false;
    }
    else
    if (document.cadastro.Email.value === "")
    {
        alert("O Campo email é obrigatório!");
        document.cadastro.Email.focus();
        return false;
    }
    else
    if (document.cadastro.Cpf.value === "")
    {
        alert("O Campo CPF é obrigatório!");
        document.cadastro.Cpf.focus();
        return false;
    }
    else
    if (document.cadastro.Origem.value === "")
    {
        alert("O Campo Origem é obrigatório!");
        document.cadastro.Origem.focus();
        return false;
    }
    else
    if (document.cadastro.Senha.value === "")
    {
        alert("Digite uma senha!");
        document.cadastro.Senha.focus();
        return false;
    }
    else
    if (document.cadastro.Confsenha.value === "")
    {
        alert("Confirme a senha!");
        document.cadastro.Confsenha.focus();
        return false;
    }
    else
        return true;
}

//fun��o-valida-cpf
function vercpf(Cpf)
{
    if (Cpf.length !== 11 || Cpf === "00000000000" || Cpf === "11111111111" || Cpf === "22222222222" || Cpf === "33333333333" || Cpf === "44444444444" || Cpf === "55555555555" || Cpf === "66666666666" || Cpf === "77777777777" || Cpf === "88888888888" || Cpf === "99999999999")
        return false;
    add = 0;
    for (i = 0; i < 9; i ++)
        add += parseInt(Cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev === 10 || rev === 11)
        rev = 0;
    if (rev !== parseInt(Cpf.charAt(9)))
        return false;
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(Cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev === 10 || rev === 11){
        rev = 0;
    }    
    if (rev !== parseInt(Cpf.charAt(10))){
        return false;
    }
//    alert('O CPF INFORMADO É VÁLIDO.');
    return true;
}

function VerificaCPF() {
    if (vercpf(document.cadastro.Cpf.value))
    {
//        document.cadastro.Cpf.focus();
    } else
    {
        errors = "1";
        if (errors){
            alert('FORNEÇA UM CPF VÁLIDO!');
            setTimeout("Cpf.focus()", 50);
            document.cadastro.Cpf.select();
        return false;
    }
//        document.retorno = (errors === '');
    }
}
//fim-fun��o-valida-cpf

//fun��o-style-do-tooltip-title
$(function () {
    var tooltips = $("[title]").tooltip({
        position: {
            my: "left top",
            at: "right+5 top-5"
        }
    });
});

//uppercase-------------------------------------------

function toUpper(element) {
                element.value = element.value.toUpperCase();
}