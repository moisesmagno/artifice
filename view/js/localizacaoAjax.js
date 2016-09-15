//Explicação 1.
////Métodos que pega o id do pais e o envia para o controller Busca, que imediatamente dispara o método actionEstado.
//Após isso é feito uma conexão do Buscacontre e buscaDAO que retornará os estado situados no banco. 
//Concluindo, toda essa informação será atribuida dentro da div estadoAjax que fica na view. 
function CarregaEstados(idpais) //Artista
{
    if(idpais){
            var myAjax = new Ajax.Updater('estadoAjax','http://localhost/projects/Artifice/PEC/Estados&idpais='+idpais,
            {
                    method : 'get',
            }) ;
    }
}

function CarregaEstadosComp(idpais) //Companhia
{
    if(idpais){
            var myAjax = new Ajax.Updater('estadoCompAjax','http://localhost/projects/Artifice/PEC/EstadosComp&idpais='+idpais,
            {
                    method : 'get',
            }) ;
    }
}

//A função deste método está descrito na explicação 1. Porém este é só para cidades.
function CarregaCidades(idestado)//Artista
{
    if(idestado){
            var myAjax = new Ajax.Updater('cidadeAjax','http://localhost/projects/Artifice/PEC/Cidades&idestado='+idestado,
            {
                    method : 'get',
            }) ;
    }
}

//A função deste método está descrito na explicação 1. Porém este é só para cidades.
function CarregaCidadesComp(idestado)//Companhia
{
    if(idestado){
            var myAjax = new Ajax.Updater('cidadeCompAjax','http://localhost/projects/Artifice/PEC/Cidades&idestado='+idestado,
            {
                    method : 'get',
            }) ;
    }
}

//-------------------------------------------------------------------------------------------------------------------------------
//DAQUI PARA BAIXO PROCURA ESTADOS E CIDADES PARA 
//-------------------------------------------------------------------------------------------------------------------------------//
function CarregaEstadosD(idpais) //Companhia
{
    if(idpais){
            var myAjax = new Ajax.Updater('estadoAjaxD','http://localhost/projects/Artifice/PEC/EstadosD&idpais='+idpais,
            {
                    method : 'get',
            }) ;
    }
}

function CarregaCidadesD(idestado) //Companhia
{
    if(idestado){
            var myAjax = new Ajax.Updater('cidadeAjaxD','http://localhost/projects/Artifice/PEC/CidadesD&idestado='+idestado,
            {
                    method : 'get',
            }) ;
    }
}