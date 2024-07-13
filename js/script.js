// Lista de Constantes usadas
const crmTool = document.getElementById("crm");
const toolTabs = document.getElementById("tool-tabs");
const linkProp = document.getElementById("proposta");
const pageProp = document.getElementById("page-proposal");
const addPage = document.getElementById("add-page");
const pageNewProp = document.getElementById("container-proposal-form");
const pageNewPropCon = document.getElementById("proposal-form");
const btnSubmit = document.getElementById("submit");

// Função para abrir a aba com as opções do CRM
crmTool.addEventListener('click', function() {
    toolTabs.style.display = toolTabs.style.display === "none" ? "flex" : "none";
});

const prop = {
    pageProposta: false,
    pageNovaProposta: true
};

// Função para definir todos os valores do objeto como false
function resetPropValues(obj) {
    for (let key in obj) {
        if (obj.hasOwnProperty(key)) {
            obj[key] = false;
        }
    }
}

linkProp.addEventListener('click', function() {
    resetPropValues(prop);
    prop.pageProposta = true; // Altera para true para o exemplo funcionar
    checkLinkProposta(); // Chama a função para verificar a alteração
});

addPage.addEventListener('click', function() {
    resetPropValues(prop);
    prop.pageNovaProposta = true; // Altera para true para o exemplo funcionar
    checkLinkProposta(); // Chama a função para verificar a alteração
});

function checkLinkProposta() {
    console.log(prop);
    pageProp.style.display = prop.pageProposta ? "flex" : "none";
    pageNewProp.style.display = prop.pageNovaProposta ? "flex" : "none";
    pageNewPropCon.style.display = prop.pageNovaProposta ? "flex" : "none";
}

// Chama a função inicialmente para mostrar o estado inicial de linkProposta
checkLinkProposta();

// Adiciona ouvintes de evento para atualizar em tempo real
const formInputs = [
    'clientName', 'solutionName', 'description', 'imageUrl',
    'aboutClientName', 'aboutSolutionName', 'aboutDescription', 'aboutImageUrl',
    'testimonialClientName', 'testimonialSolutionName', 'testimonialDescription', 'testimonialImageUrl',
    'testimonialVideoUrl', 'offerClientName', 'offerSolutionName', 'offerDescription', 'offerImageUrl'
];

formInputs.forEach(inputId => {
    document.getElementById(inputId).addEventListener('input', formObj);
});

btnSubmit.addEventListener('click', function() {
    formObj();
});

// Função para coletar os dados do formulário
function formObj() {
    const formData = {
        clientName: document.getElementById('clientName').value,
        solutionName: document.getElementById('solutionName').value,
        description: document.getElementById('description').value,
        imageUrl: document.getElementById('imageUrl').value,
        aboutClientName: document.getElementById('aboutClientName').value,
        aboutSolutionName: document.getElementById('aboutSolutionName').value,
        aboutDescription: document.getElementById('aboutDescription').value,
        aboutImageUrl: document.getElementById('aboutImageUrl').value,
        testimonialClientName: document.getElementById('testimonialClientName').value,
        testimonialSolutionName: document.getElementById('testimonialSolutionName').value,
        testimonialDescription: document.getElementById('testimonialDescription').value,
        testimonialImageUrl: document.getElementById('testimonialImageUrl').value,
        testimonialVideoUrl: document.getElementById('testimonialVideoUrl').value,
        offerClientName: document.getElementById('offerClientName').value,
        offerSolutionName: document.getElementById('offerSolutionName').value,
        offerDescription: document.getElementById('offerDescription').value,
        offerImageUrl: document.getElementById('offerImageUrl').value
    };

    fetch('save_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        displayProposalData(formData); // Supondo que você tenha essa função para exibir os dados
    })
    .catch(error => console.error('Error:', error));
    
    // Exibe o objeto no console (ou envie para o servidor)
    console.log(formData);
    displayProposalData(formData);
}

// Função para exibir os dados da proposta
function displayProposalData(formData) {
    const proposalDataDiv = document.getElementById('proposalData');
    proposalDataDiv.innerHTML = `
        <h2>Informações do Cliente</h2>
        <p><strong>Nome do Cliente:</strong> ${formData.clientName}</p>
        <p><strong>Nome da Solução:</strong> ${formData.solutionName}</p>
        <p><strong>Descrição:</strong> ${formData.description}</p>
        <p><strong>URL da Imagem:</strong> ${formData.imageUrl}</p>

        <h2>Sobre Mim</h2>
        <p><strong>Título:</strong> ${formData.aboutClientName}</p>
        <p><strong>Sub-Título:</strong> ${formData.aboutSolutionName}</p>
        <p><strong>Parágrafo:</strong> ${formData.aboutDescription}</p>
        <p><strong>URL da Imagem:</strong> ${formData.aboutImageUrl}</p>

        <h2>Depoimentos</h2>
        <p><strong>Título:</strong> ${formData.testimonialClientName}</p>
        <p><strong>Sub-Título:</strong> ${formData.testimonialSolutionName}</p>
        <p><strong>Parágrafo:</strong> ${formData.testimonialDescription}</p>
        <p><strong>URL da Imagem:</strong> ${formData.testimonialImageUrl}</p>
        <p><strong>URL do Vídeo:</strong> ${formData.testimonialVideoUrl}</p>

        <h2>Ofertas</h2>
        <p><strong>Título:</strong> ${formData.offerClientName}</p>
        <p><strong>Sub-Título:</strong> ${formData.offerSolutionName}</p>
        <p><strong>Parágrafo:</strong> ${formData.offerDescription}</p>
        <p><strong>URL da Imagem:</strong> ${formData.offerImageUrl}</p>
    `;
}
