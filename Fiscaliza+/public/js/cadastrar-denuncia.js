document.addEventListener('DOMContentLoaded', function () {
  const photoButton = document.querySelector('.action-button.photo');
  const videoButton = document.querySelector('.action-button.video');
  const locationButton = document.querySelector('.action-button.location');
  const sendButton = document.querySelector('.send-button');

  const photoInput = document.getElementById('photoInput');
  const videoInput = document.getElementById('videoInput');
  const locationInput = document.getElementById('locationInput');
  const textMessage = document.getElementById('textMessage');
  const feedback = document.getElementById('feedbackMessage');

  function showFeedback(message, isError = true) {
    feedback.textContent = message;
    feedback.style.color = isError ? 'red' : 'green';
    if (!isError) {
      setTimeout(() => {
        feedback.textContent = '';
      }, 4000); // limpa a mensagem após 4 segundos
    }
  }

  photoButton.addEventListener('click', () => {
    photoInput.click();
  });

  videoButton.addEventListener('click', () => {
    videoInput.click();
  });

  locationButton.addEventListener('click', () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;
          locationInput.value = `${latitude},${longitude}`;
          showFeedback('Localização capturada com sucesso!', false);
        },
        (error) => {
          showFeedback('Erro ao capturar a localização: ' + error.message);
        }
      );
    } else {
      showFeedback('Geolocalização não suportada pelo navegador.');
    }
  });

  sendButton.addEventListener('click', () => {
    const mensagem = textMessage.value.trim();
    const fotoFile = photoInput.files[0];
    const videoFile = videoInput.files[0];
    const localizacao = locationInput.value;

    if (!mensagem && !fotoFile && !videoFile && !localizacao) {
      showFeedback('Por favor, insira uma mensagem, foto, vídeo ou localização antes de enviar.');
      return;
    }

    const formData = new FormData();
    formData.append('descricao', mensagem);
    formData.append('titulo', mensagem.substring(0, 50)); // Usa primeiras 50 chars como título
    if (fotoFile) formData.append('foto', fotoFile);
    if (videoFile) formData.append('video', videoFile);
    if (localizacao) formData.append('localizacao', localizacao);

    // NÃO precisa mais enviar nome_usuario - será pego automaticamente do usuário logado

    // Requisição real para o backend Laravel
    fetch('/denuncia', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro na requisição');
      }
      return response.json();
    })
    .then(data => {
      showFeedback('Denúncia enviada com sucesso!', false);
      // Limpa os campos
      textMessage.value = '';
      photoInput.value = '';
      videoInput.value = '';
      locationInput.value = '';
    })
    .catch(error => {
      console.error('Erro:', error);
      showFeedback('Erro ao enviar denúncia. Tente novamente.');
    });
  });
});