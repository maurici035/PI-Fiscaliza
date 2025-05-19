document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Impede envio padrão

      const email = document.getElementById('email').value.trim();
      const senha = document.getElementById('senha').value.trim();

      if (!email || !senha) {
        alert('Por favor, preencha todos os campos.');
        return;
      }

      // Aqui você pode adicionar lógica para autenticação (ex: fetch para API)
      alert(`Login com:\nEmail: ${email}\nSenha: ${senha}`);
    });