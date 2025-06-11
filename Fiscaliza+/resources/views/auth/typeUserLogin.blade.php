<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fiscaliza+ | Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#4361ee',
            secondary: '#3f37c9',
            accent: '#4895ef',
            dark: '#1e1e2c',
            light: '#f8f9fa'
          }
        }
      }
    }
  </script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    .background {
      background: url('{{ asset("assets/imagem_de_fundo.jpeg") }}') no-repeat center center fixed;
      background-size: cover;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      z-index: -2;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: rgba(0, 0, 0, 0.3);
      z-index: -1;
    }

    .pulse {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7); }
      70% { box-shadow: 0 0 0 10px rgba(67, 97, 238, 0); }
      100% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative">

  <div class="background"></div>
  <div class="overlay"></div>

  <div class="login-container z-10 w-full max-w-md">
    <div class="login-box bg-white rounded-2xl overflow-hidden relative shadow-lg">
      <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-primary to-accent"></div>
      <div class="pt-16 px-8 pb-8">

        <div class="flex justify-center mb-6">
          <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Logo" class="h-20">
        </div>

        <h2 class="text-2xl font-bold text-center text-dark mb-6">Escolha como quer se logar</h2>

        <a href="{{route('login')}}" class="w-full py-3 bg-primary text-white font-semibold rounded-xl flex items-center justify-center mt-2">
            Logar como pessoa
        </a>
        <a href="{{route('empresa.login')}}" class="w-full py-3 bg-primary text-white font-semibold rounded-xl flex items-center justify-center mt-2">
            Logar como empresa
        </a>

      <div class="bg-gray-50 px-8 py-4 text-center border-t border-gray-100">
        <p class="text-gray-600 text-sm">
          Não tem uma conta?
          <a href="{{route('typeuser')}}" class="text-primary font-medium hover:text-secondary transition">Criar conta</a>
        </p>
      </div>
    </div>

    <div class="mt-6 text-center">
      <p class="text-white text-sm opacity-80">© 2023 Fiscaliza+. Todos os direitos reservados.</p>
    </div>
  </div>
</body>
</html>
