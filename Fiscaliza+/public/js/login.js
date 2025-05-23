document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  const emailInput = document.getElementById('email');
  const senhaInput = document.getElementById('senha');

  form.addEventListener('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const email = emailInput.value.trim();
    const senha = senhaInput.value.trim();

    if (email === '' || senha === '') {
      alert('Por favor, preencha o email e a senha.');
      return;
    }

    // Redireciona se os campos estiverem preenchidos
    window.location.href = 'home';
  });
});
