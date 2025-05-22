function pegarLocalizacao() {
  const inputLocalizacao = document.getElementById('inputLocalizacao');

  if (!navigator.geolocation) {
    alert('Geolocalização não suportada pelo seu navegador.');
    return;
  }

  inputLocalizacao.style.display = 'block';
  inputLocalizacao.value = 'Obtendo localização...';

  navigator.geolocation.getCurrentPosition(
    (position) => {
      const lat = position.coords.latitude.toFixed(6);
      const lon = position.coords.longitude.toFixed(6);
      inputLocalizacao.value = `Latitude: ${lat}, Longitude: ${lon}`;
    },
    (error) => {
      inputLocalizacao.value = '';
      alert('Erro ao obter localização: ' + error.message);
      console.error(error);
    }
  );
}

function enviarPostagem() {
  const texto = document.getElementById("postTexto").value.trim();
  const imagem = document.getElementById("inputImagem").files[0];
  const video = document.getElementById("inputVideo").files[0];
  const localizacao = document.getElementById("inputLocalizacao").value.trim();

  // ✅ Verifica se todos os campos estão vazios
  if (!texto && !imagem && !video && !localizacao) {
    alert("Você precisa adicionar um texto, imagem, vídeo ou localização.");
    return;
  }

  // ✅ Verifica tamanho do vídeo
  if (video && video.size > 50 * 1024 * 1024) {
    alert("O vídeo não pode ter mais de 50MB.");
    return;
  }

  alert("Postagem enviada com sucesso!");

  // ✅ Limpa os campos após o envio
  document.getElementById("postTexto").value = "";
  document.getElementById("inputImagem").value = "";
  document.getElementById("inputVideo").value = "";
  document.getElementById("inputLocalizacao").value = "";
  document.getElementById("inputLocalizacao").style.display = "none";
}