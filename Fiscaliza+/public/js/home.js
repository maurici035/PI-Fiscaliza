document.addEventListener('DOMContentLoaded', function() {
    // Variáveis globais para o modal de comentário e id selecionado
    window.denunciaIdSelecionada = null;
    window.modalComentario = new bootstrap.Modal(document.getElementById('modalComentario'));
    const modalConteudo = new bootstrap.Modal(document.getElementById('modalConteudo'));
    const modalCompartilhar = new bootstrap.Modal(document.getElementById('modalCompartilhar'));

    // Função global para abrir o modal de comentário
    window.comentarDenuncia = function(button, denunciaId) {
        document.getElementById('inputComentario').value = '';
        window.denunciaIdSelecionada = denunciaId;
        window.modalComentario.show();
    };

    // Função global para abrir o modal de conteúdo
    window.abrirConteudo = function(button) {
        const card = button.closest('.complaint-card');
        const title = card.querySelector('.complaint-title').innerText;
        const content = card.querySelector('.complaint-text').innerText;

        document.getElementById('modalConteudoLabel').innerText = `📌 ${title}`;
        document.getElementById('modalConteudoBody').innerText = content;

        modalConteudo.show();
    };

    // Função global para curtir denúncia
    window.curtirDenuncia = function(button) {
        const countSpan = button.querySelector('.like-count');
        let count = parseInt(countSpan.innerText) || 0;
        count++;
        countSpan.innerText = count;
    };

    // Função global para compartilhar denúncia
    window.compartilharDenuncia = function(button) {
        const card = button.closest('.complaint-card');
        const denunciaId = card.getAttribute('data-denuncia-id'); // Adicione esse atributo no HTML do card

        const url = `${window.location.origin}/denuncia/${denunciaId}`;

        document.getElementById('modalCompartilharLabel').innerText = `🔗 Compartilhar denúncia`;
        document.getElementById('modalCompartilharBody').innerHTML = `
            <input type="text" class="form-control" value="${url}" readonly style="margin-bottom:10px;">
            <button class="btn btn-success" onclick="navigator.clipboard.writeText('${url}')">Copiar link</button>
            <a href="${url}" target="_blank" class="btn btn-primary" style="margin-left:10px;">Abrir denúncia</a>
        `;

        modalCompartilhar.show();
    };

    // Envio do comentário
    document.getElementById('formComentario').addEventListener('submit', function (e) {
        e.preventDefault();
        const texto = document.getElementById('inputComentario').value.trim();
        const denunciaId = window.denunciaIdSelecionada;
        if (texto.length === 0) {
            alert('Por favor, digite um comentário antes de enviar.');
            return;
        }
        if (!denunciaId) {
            alert('Erro interno: denúncia não selecionada.');
            return;
        }

        fetch('/comentario', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                denuncia_id: denunciaId,
                texto: texto
            })
        })
        .then(response => response.json())
        .then(data => {
            alert('Comentário enviado com sucesso!');
            document.getElementById('inputComentario').value = '';
            window.modalComentario.hide();
            window.denunciaIdSelecionada = null;
        })
        .catch(error => {
            alert('Erro ao enviar comentário');
            console.error(error);
        });
    });

    // Envio de denúncia
    const formDenuncia = document.getElementById('formDenuncia');
    if (formDenuncia) {
        formDenuncia.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('/denuncia', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then (data => {
                alert('Denúncia enviada com sucesso!');
                // opcional: limpar o form ou fechar modal
            })
            .catch(error => {
                alert('Erro ao enviar denúncia');
                console.error(error);
            });
        });
    }

    // Upload de arquivos
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

    // Botões de vídeo, foto e localização
    const btnVideo = document.querySelector('.option-btn.video');
    if (btnVideo) {
        btnVideo.addEventListener('click', function () {
            document.getElementById('videoInput').click();
        });
    }

    const inputVideo = document.getElementById('videoInput');
    if (inputVideo) {
        inputVideo.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                uploadFile(file, 'video');
            }
        });
    }

    const btnPhoto = document.querySelector('.option-btn.photo');
    if (btnPhoto) {
        btnPhoto.addEventListener('click', function () {
            document.getElementById('photoInput').click();
        });
    }

    const inputPhoto = document.getElementById('photoInput');
    if (inputPhoto) {
        inputPhoto.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                uploadFile(file, 'foto');
            }
        });
    }

    const btnLocation = document.querySelector('.option-btn.location');
    if (btnLocation) {
        btnLocation.addEventListener('click', function () {
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
    }

    // Função global para confirmar deleção de denúncia
    window.confirmarDelete = function(denunciaId) {
        const form = document.getElementById('formDeleteDenuncia');
        form.action = '/denuncia/' + denunciaId;
        const modal = new bootstrap.Modal(document.getElementById('modalDeleteDenuncia'));
        modal.show();
    }
});
