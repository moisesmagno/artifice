// VALIDANDO O FORMULÁRIO INSERIR. 
function valida(){
    d=document.form_cadastro_usu;

    if (d.nome.value == '' ){
            alert("Por favor infone seu nome!");
            d.senha.focus();
            return false;
    } 

    if (d.email.value == ""){
    alert("Informe o seu E-mail!");
    d.email.focus();
    return false;
    }
    parte1 = d.email.value.indexOf("@");
    parte2 = d.email.value.indexOf(".");
    parte3 = d.email.value.length;
    if (!(parte1 >= 3 && parte2 >= 6 && parte3 >= 9)) {
            alert("Insira um E-mail válido!");
            d.email.focus();
            return false;
    }

    if (d.senha.value == ''){
            alert("Insira uma senha!");
            d.senha.focus();
            return false;
    } 

    if (d.senha_conf.value == ''){
            alert("Confirme a senha!");
            d.senha.focus();
            return false;
    } 

    if (d.tipo_perfil.value == '3'){
            alert("Informe se você é Artista ou é uma Companhia!");
            d.tipo_perfil.focus();
            return false;
    } 

    if (d.senha.value != d.senha_conf.value){
            alert("As senhas digitadas não são iguais, por favor verificar!");
            d.senha.focus();
            return false;
    }  

    return true;
    
    
}// FIM DA VALIDAÇÃO DO FORMULÁRIO INSERIR.                 

