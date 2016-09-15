//BOTÃO EXIBIR PORTFOLIO    
jQuery(function() {
    jQuery( "#exi_port" ).click(function() {
    jQuery( ".exi_portf" ).addClass( "ex_port_oculto", 1000);  
    jQuery( ".porfolio_oculto" ).addClass( "portfolio", 1000);
    jQuery( ".rec_port_oculto" ).addClass( "rec_port", 1000);
      return false;
    });
});    


jQuery(function() {
    jQuery( "#rec_port" ).click(function() {
    jQuery( ".porfolio_oculto" ).removeClass( "portfolio", 1000);
    jQuery( ".rec_port_oculto" ).removeClass( "rec_port", 1000);
    jQuery( ".exi_portf" ).removeClass( "ex_port_oculto", 1000);
        return false;
    });
});// FIM DO BOTÃO EXIBIR PORTFOLIO. 

//Email de recuperação de conta.
jQuery(function() {
    jQuery( "#re" ).click(function() {
    jQuery( ".for_recup_conta" ).addClass( "for_recup_conta_block", 1000);
    jQuery( ".recemail" ).addClass( "recemail_none", 1000); 
      return false;
    });
});    


jQuery(function() {
    jQuery( "#cc" ).click(function() {
    jQuery( ".for_recup_conta" ).removeClass( "for_recup_conta_block", 1000);
    jQuery( ".recemail" ).removeClass( "recemail_none", 1000);
        return false;
    });
});// FIM DO BOTÃO EXIBIR PORTFOLIO. 