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
  // Novo: elemento para mensagem de sucesso de upload
  const uploadSuccessMessage = document.getElementById('uploadSuccessMessage');
  const tituloInput = document.getElementById('tituloInput');

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

  // Mensagem de sucesso ao adicionar imagem
  photoInput.addEventListener('change', function () {
    console.log('photoInput change', photoInput.files);
    if (photoInput.files.length > 0) {
      uploadSuccessMessage.textContent = 'Imagem enviada com sucesso';
      uploadSuccessMessage.style.color = 'green';
    } else {
      uploadSuccessMessage.textContent = '';
    }
  });

  // Mensagem de sucesso ao adicionar vídeo
  videoInput.addEventListener('change', function () {
    console.log('videoInput change', videoInput.files);
    if (videoInput.files.length > 0) {
      uploadSuccessMessage.textContent = 'Vídeo enviado com sucesso';
      uploadSuccessMessage.style.color = 'green';
    } else {
      uploadSuccessMessage.textContent = '';
    }
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
    formData.append('titulo', tituloInput.value.trim()); // Usa o valor do campo título
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
      uploadSuccessMessage.textContent = ''; // Limpa mensagem de upload após envio
    })
    .catch(error => {
      console.error('Erro:', error);
      showFeedback('Erro ao enviar denúncia. Tente novamente.');
    });
  });
});