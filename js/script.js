//Lista de Constantes usadas
const crmTool = document.getElementById("crm");
const toolTabs = document.getElementById("tool-tabs");
const proposal = document.getElementById("proposta");
const pageProposal = document.getElementById("page-proposal");
const addPage = document.getElementById("add-page")//Botão Criar Nova Pagina
const pageProposalNew = document.getElementById("proposal-form")//Pagina para criar novas propostas
const btnCont = document.getElementById("conteudo")//Link para abrir a aba de conteudo
const btnApa = document.getElementById("aparencia")//Link para abrir a aba dfe aparencia

//Funcão para abrir a aba com as opções do CRM
crmTool.addEventListener('click', function(){
    if (toolTabs.style.display === "none") {
        toolTabs.style.display = "flex";
    } else {
        toolTabs.style.display = "none";
    }
})

proposal.addEventListener('click', function(){
    pageProposal.style.display = "flex";
})

addPage.addEventListener('click', function(){
    pageProposal.style.display = "none";
    pageProposalNew.style.display = "flex";
})

btnCont.addEventListener('click', function(){
    pageProposal.style.display = "none";
    pageProposalNew.style.display = "flex";
})

btnApa.addEventListener('click', function(){
    pageProposal.style.display = "none";
    pageProposalNew.style.display = "none";
})

