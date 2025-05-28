// Mostrar e esconder modal
    const modalOverlay = document.getElementById('modal-overlay');
    const btnAlterarSenha = document.getElementById('btn-alterar-senha');
    const btnCancelarSenha = document.getElementById('cancelar-senha');
    const btnConfirmarSenha = document.getElementById('confirmar-senha');
    const inputNovaSenha = document.getElementById('nova-senha');
    const inputConfirmaSenha = document.getElementById('confirma-senha');
    const modalMessage = document.getElementById('modal-message');

    btnAlterarSenha.addEventListener('click', () => {
      inputNovaSenha.value = '';
      inputConfirmaSenha.value = '';
      modalMessage.style.display = 'none';
      modalOverlay.style.display = 'flex';
      inputNovaSenha.focus();
    });

    btnCancelarSenha.addEventListener('click', () => {
      modalOverlay.style.display = 'none';
    });

    btnConfirmarSenha.addEventListener('click', () => {
      const novaSenha = inputNovaSenha.value.trim();
      const confirmaSenha = inputConfirmaSenha.value.trim();

      if (novaSenha.length < 6) {
        modalMessage.textContent = 'A senha deve ter pelo menos 6 caracteres.';
        modalMessage.className = 'message error';
        modalMessage.style.display = 'block';
        return;
      }

      if (novaSenha !== confirmaSenha) {
        modalMessage.textContent = 'As senhas não coincidem.';
        modalMessage.className = 'message error';
        modalMessage.style.display = 'block';
        return;
      }

      // Simular alteração de senha (ex: chamada ao backend)
      modalMessage.textContent = 'Alterando senha...';
      modalMessage.className = 'message success';
      modalMessage.style.display = 'block';

      setTimeout(() => {
        modalOverlay.style.display = 'none';
        alert('Senha alterada com sucesso!');
        // Aqui poderia enviar para backend, ex: fetch('/api/alterar-senha', {...})
        console.log('Senha alterada:', novaSenha);
      }, 1000);
    });

    // Validação e submissão do formulário
    const form = document.getElementById('profile-form');
    const formMessage = document.getElementById('form-message');

    function validarTelefone(tel) {
      if (!tel) return true; // telefone opcional
      const regex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
      return regex.test(tel);
    }

    function validarData(data) {
      if (!data) return false;
      // Verifica formato dd/mm/aaaa
      const regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;
      if (!regex.test(data)) return false;

      const [dia, mes, ano] = data.split('/').map(Number);
      const dt = new Date(ano, mes - 1, dia);
      return dt && dt.getDate() === dia && dt.getMonth() === mes - 1 && dt.getFullYear() === ano;
    }

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      formMessage.style.display = 'none';

      const email = form.email.value.trim();
      const nascimento = form.nascimento.value.trim();
      const nome = form.nome.value.trim();
      const telefone1 = form.telefone1.value.trim();
      const telefone2 = form.telefone2.value.trim();

      if (!email || !nome || !nascimento) {
        formMessage.textContent = 'Por favor, preencha os campos obrigatórios.';
        formMessage.className = 'message error';
        formMessage.style.display = 'block';
        return;
      }

      // Valida email com regex simples
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        formMessage.textContent = 'Digite um email válido.';
        formMessage.className = 'message error';
        formMessage.style.display = 'block';
        return;
      }

      if (!validarData(nascimento)) {
        formMessage.textContent = 'Data de nascimento inválida. Use dd/mm/aaaa.';
        formMessage.className = 'message error';
        formMessage.style.display = 'block';
        return;
      }

      if (!validarTelefone(telefone1) || !validarTelefone(telefone2)) {
        formMessage.textContent = 'Telefone inválido. Use o formato (00) 00000-0000.';
        formMessage.className = 'message error';
        formMessage.style.display = 'block';
        return;
      }

      // Simular envio para backend
      formMessage.textContent = 'Salvando dados...';
      formMessage.className = 'message success';
      formMessage.style.display = 'block';

      setTimeout(() => {
        formMessage.textContent = 'Dados salvos com sucesso!';
        console.log({ email, nascimento, nome, telefone1, telefone2 });
      }, 1000);
    });