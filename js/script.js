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
    pageNovaProposta: false
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
    document.getElementById(inputId).addEventListener('input', function() {
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
        displayProposalData(formData);
    });
});

// Intercepta o envio do formulário
btnSubmit.addEventListener('click', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    formObj();
});

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
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(`Proposta salva com sucesso! Veja sua proposta aqui: ${data.proposal_link}`);
        }
        if (data.proposal_link) {
            const linkContainer = document.getElementById('link-container');
            const linkDiv = document.createElement('div');
            linkDiv.innerHTML = `<a href="${data.proposal_link}" target="_blank">Ver Proposta</a>`;
            linkContainer.appendChild(linkDiv);
        }
    })
    .catch(error => console.error('Error:', error));

    alert("Formulario Salvo")
    loadProposals()
}

function displayProposalData(formData) {
    const proposalDataDiv = document.getElementById('proposalDataPhone');
    proposalDataDiv.innerHTML = `
        <div class="container-phone mt-5">
            <div class="intro-phone mb-4">
                <h1>Olá, <span>${formData.clientName}</span>. Esta é</h1>
                <h2>Proposta<br> Comercial</h2>
            </div>

            <div class="proposal-phone mt-4">
                <h2>Detalhes da Proposta</h2>
                <p><strong>Nome da Solução:</strong> ${formData.solutionName}</p>
                <p><strong>Descrição:</strong> ${formData.description}</p>
            </div>

            <div class="about-phone mt-4">
                <h2>Sobre Mim</h2>
                <div class="about-container-phone">
                    <div>
                        <p>${formData.aboutClientName}</p>
                        <p>${formData.aboutSolutionName}</p>
                        <p>${formData.aboutDescription}</p>
                    </div>
                    <div>
                        <p><img src="${formData.aboutImageUrl}" alt="Imagem sobre mim" class="img-fluid"></p>
                    </div>
                </div>
            </div>

            <div class="testimonials-phone mt-4">
                <h2>Depoimentos</h2>
                <h3>${formData.testimonialClientName}</h3>
                <p>${formData.testimonialSolutionName}</p>
                <p>${formData.testimonialDescription}</p>
                <p><a href="${formData.testimonialVideoUrl}" class="btn btn-primary">Ver Vídeo</a></p>
            </div>

            <div class="off-phone mt-4">
                <h2>Ofertas</h2>
                <p>${formData.offerClientName}</p>
                <p>${formData.offerSolutionName}</p>
                <p>${formData.offerDescription}</p>
                <p><img src="${formData.offerImageUrl}" alt="Imagem da oferta" class="img-fluid"></p>
            </div>
        </div>
    `;
}

async function loadProposals() {
    const response = await fetch('./get_proposals.php'); // URL para o arquivo PHP que retorna as propostas
    const proposals = await response.json();

    const proposalsContainer = document.getElementById('proposals-container');

    if (proposals.length === 0) {
        proposalsContainer.innerHTML = '<p>Nenhuma proposta encontrada.</p>';
    } else {
        proposals.forEach(proposal => {
            const proposalDiv = document.createElement('div');
            proposalDiv.classList.add('form-client');
            proposalDiv.innerHTML = `
                <div class="client-div">
                    <div class="name-client">
                        <h1>Nome do Cliente:</h1>
                        <h1>${proposal.clientName}</h1>
                    </div>
                    <div class="name-client">
                        <h1>Nome da Página:</h1>
                        <h1>${proposal.solutionName}</h1>
                    </div>
                </div>
                <div class="client-btn">
                    <button type="button" onclick="window.location.href='view_proposal.php/${proposal.username}/${proposal.id}'">Ver Proposta</button>
                    <button type="button">Editar</button>
                </div>
            `;

            proposalsContainer.appendChild(proposalDiv);
        });
    }
}

// Carregar propostas ao iniciar a página
window.onload = loadProposals;
