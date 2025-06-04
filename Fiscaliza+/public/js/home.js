document.querySelector('.option-btn.video').addEventListener('click', function () {
    document.getElementById('videoInput').click();
});

document.getElementById('videoInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        uploadFile(file, 'video');
    }
});

document.querySelector('.option-btn.photo').addEventListener('click', function () {
    document.getElementById('photoInput').click();
});

document.getElementById('photoInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        uploadFile(file, 'foto');
    }
});

document.querySelector('.option-btn.location').addEventListener('click', function () {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const locationData = {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            };
            document.getElementById('locationInput').value = JSON.stringify(locationData);
            alert(`Localização capturada:\nLatitude: ${locationData.latitude}\nLongitude: ${locationData.longitude}`);
        }, function (error) {
            alert("Erro ao obter localização: " + error.message);
        });
    } else {
        alert("Geolocalização não suportada.");
    }
});

function uploadFile(file, tipo) {
    const formData = new FormData();
    formData.append("file", file);
    formData.append("tipo", tipo);
    formData.append("localizacao", document.getElementById('locationInput').value);

    fetch('../backend/upload.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(result => {
            alert("Upload concluído: " + result.message);
        })
        .catch(error => {
            console.error("Erro no upload:", error);
            alert("Erro ao enviar o arquivo.");
        });
}

const modalConteudo = new bootstrap.Modal(document.getElementById('modalConteudo'));
const modalComentario = new bootstrap.Modal(document.getElementById('modalComentario'));
const modalCompartilhar = new bootstrap.Modal(document.getElementById('modalCompartilhar'));

function abrirConteudo(button) {
    const card = button.closest('.complaint-card');
    const title = card.querySelector('.complaint-title').innerText;
    const content = card.querySelector('.complaint-text').innerText;

    document.getElementById('modalConteudoLabel').innerText = `📌 ${title}`;
    document.getElementById('modalConteudoBody').innerText = content;

    modalConteudo.show();
}

function curtirDenuncia(button) {
    const countSpan = button.querySelector('.like-count');
    let count = parseInt(countSpan.innerText) || 0;
    count++;
    countSpan.innerText = count;
}

function comentarDenuncia(button) {
    document.getElementById('inputComentario').value = '';
    modalComentario.show();
}

document.getElementById('formComentario').addEventListener('submit', function (e) {
    e.preventDefault();
    const texto = document.getElementById('inputComentario').value.trim();
    if (texto.length === 0) {
        alert('Por favor, digite um comentário antes de enviar.');
        return;
    }
    modalComentario.hide();

    alert('💬 Comentário enviado: ' + texto);
});

function compartilharDenuncia(button) {
    const card = button.closest('.complaint-card');
    const title = card.querySelector('.complaint-title').innerText;

    document.getElementById('modalCompartilharLabel').innerText = `🔗 Compartilhar: "${title}"`;
    document.getElementById('modalCompartilharBody').innerText = '(Link simulado copiado para a área de transferência!)';

    modalCompartilhar.show();

    // Tenta copiar para a área de transferência
    navigator.clipboard.writeText(`https://fiscaliza.com/denuncia/${encodeURIComponent(title)}`).catch(() => {
        // fallback opcional
    });
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      const coords = position.coords.latitude + ',' + position.coords.longitude;
      document.getElementById('locationInput').value = coords;
      alert('Localização capturada!');
    }, function() {
      alert('Não foi possível capturar a localização.');
    });
  } else {
    alert('Geolocalização não suportada pelo navegador.');
  }
}

document.getElementById('formDenuncia').addEventListener('submit', function(e) {
  e.preventDefault(); // previne recarregar a página

  const formData = new FormData(this);

  fetch('/denuncia', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => response.json())
  .then(data => {
    alert('Denúncia enviada com sucesso!');
    // opcional: limpar o form ou fechar modal
  })
  .catch(error => {
    alert('Erro ao enviar denúncia');
    console.error(error);
  });
});

// Supondo que você recebe um array de denúncias do backend
function renderDenuncias(denuncias) {
    const lista = document.getElementById('listaDenuncias');
    lista.innerHTML = '';

    denuncias.forEach(denuncia => {
        const card = document.createElement('div');
        card.className = 'complaint-card';

        // Adiciona a imagem se existir
        let imgHtml = '';
        if (denuncia.foto_path) {
            imgHtml = `<img src="/storage/${denuncia.foto_path}" alt="Imagem da denúncia" class="complaint-image" style="max-width:100%;margin-bottom:8px;">`;
        }

        card.innerHTML = `
            ${imgHtml}
            <div class="complaint-title">${denuncia.titulo}</div>
            <div class="complaint-text">${denuncia.descricao}</div>
            <!-- outros campos -->
        `;

        lista.appendChild(card);
    });
}
