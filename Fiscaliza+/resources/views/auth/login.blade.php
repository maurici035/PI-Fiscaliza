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

        <div class="text-center mb-8">
          <h2 class="text-3xl font-semibold text-gray-800 mb-2">Pessoa</h2>
          <h2 class="text-2xl font-bold text-center text-dark mb-6">Faça seu login</h2>
        </div>

        <!-- MENSAGENS DO SERVIDOR -->
        @if(session('success'))
          <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-4">
            @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif

        <!-- FORMULÁRIO -->
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="space-y-4">
            <!-- Email -->
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
              </div>
              <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email') }}" 
                placeholder="Email" 
                required 
                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition"
              />
            </div>

            <!-- Senha -->
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
              </div>
              <input 
                type="password" 
                name="senha" 
                id="senha" 
                placeholder="Senha" 
                required 
                class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition"
              />
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <button type="button" class="text-gray-400 hover:text-gray-600" id="togglePassword">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>

            <div class="flex justify-end">
              <a href="telaRecuperarSenha.html" class="text-sm text-primary hover:text-secondary font-medium transition">Esqueci minha senha</a>
            </div>

            <button type="submit" class="w-full py-3 bg-primary text-white font-semibold rounded-xl flex items-center justify-center mt-2 pulse">
              Entrar <span class="ml-2 text-xl">&rarr;</span>
            </button>
          </div>
        </form>
      </div>

      <div class="bg-gray-50 px-8 py-4 text-center border-t border-gray-100">
        <p class="text-gray-600 text-sm">
          Não tem uma conta?
          <a href="{{route('cadastro')}}" class="text-primary font-medium hover:text-secondary transition">Cadastre-se</a>
        </p>
      </div>
    </div>

    <div class="mt-6 text-center">
      <p class="text-white text-sm opacity-80">© 2023 Fiscaliza+. Todos os direitos reservados.</p>
    </div>
  </div>

  <script>
    // Mostrar/ocultar senha
    const toggle = document.getElementById("togglePassword");
    const password = document.getElementById("senha");
    toggle.addEventListener("click", function () {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      this.querySelector('i').classList.toggle("fa-eye");
      this.querySelector('i').classList.toggle("fa-eye-slash");
    });
  </script>
</body>
</html>
