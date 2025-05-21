function validarFormulario() {
      const nome = document.getElementById("nome").value.trim();
      const email = document.getElementById("email").value.trim();
      const senha = document.getElementById("senha").value;
      const repitaSenha = document.getElementById("repitaSenha").value;
      const dataNascimento = document.getElementById("dataNascimento").value;
      const termsChecked = document.getElementById("terms").checked;

      // Verificações
      if (!nome || !email || !senha || !repitaSenha || !dataNascimento) {
        alert("Por favor, preencha todos os campos.");
        return;
      }

      if (!validarEmail(email)) {
        alert("E-mail inválido.");
        return;
      }

      if (senha !== repitaSenha) {
        alert("As senhas não coincidem.");
        return;
      }

      if (!termsChecked) {
        alert("Você deve concordar com os Termos da Plataforma.");
        return;
      }

      // Simula envio bem-sucedido
      alert("Cadastro realizado com sucesso!");
      // Aqui você pode adicionar uma chamada AJAX ou redirecionamento
      window.location.href = "../views/home.html";
    }

    function validarEmail(email) {
      // Expressão regular simples para validação de e-mail
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return regex.test(email);
    }