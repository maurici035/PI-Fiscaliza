<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fiscaliza+ | Cadastro</title>
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
      background: url('{{ asset("assets/imagem_de_fundo.jpeg") }}') no-repeat center center;
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
  </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative">

  <div class="background"></div>
  <div class="overlay"></div>

  <div class="z-10 w-full max-w-md">
    <div class="bg-white rounded-2xl overflow-hidden relative shadow-lg">
      <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-primary to-accent"></div>
      <div class="pt-16 px-8 pb-8">
        <div class="flex justify-center mb-4">
          <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Fiscaliza+ Logo" class="h-16">
        </div>

      <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-2">Pessoa</h2>
        <h2 class="text-2xl font-bold text-dark">Cadastre-se</h2>
      </div>


        <form action="/register" method="POST">
          @csrf

          <div class="space-y-4">
            <div>
            <input type="text" name="nome" placeholder="Nome" required
                value="{{ old('nome') }}"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            @error('nome')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            <div>
            <input type="email" name="email" placeholder="E-mail" required
                value="{{ old('email') }}"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            <div>
            <input type="password" name="senha" placeholder="Senha" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            @error('senha')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            <div>
            <input type="password" name="repitaSenha" placeholder="Repita a Senha" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            @error('repitaSenha')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            <div>
            <input type="date" name="dataNascimento" placeholder="Data de Nascimento" required
                value="{{ old('dataNascimento') }}"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            @error('dataNascimento')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @error('idade')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>
            <div class="flex items-center space-x-2">
              <input type="checkbox" name="terms" required id="terms" class="accent-primary w-4 h-4">
              <label for="terms" class="text-sm text-gray-600">
                Li, entendi e concordo com os <a href="{{ route('termos') }}" class="text-blue-600 hover:underline">Termos e Condições</a>.
              </label>
            </div>


            <button type="submit"
              class="w-full py-3 bg-primary text-white font-semibold rounded-xl flex items-center justify-center mt-2 hover:bg-secondary transition">
              CADASTRAR
            </button>
          </div>
        </form>
      </div>

      <div class="bg-gray-50 px-8 py-4 text-center border-t border-gray-100 mb-4">
        <p class="text-gray-600 text-sm">
          Já tem uma conta?
          <a href="{{ route('login') }}" class="text-primary font-medium hover:text-secondary transition">Entrar</a>
        </p>
      </div>
    </div>

    <div class="mt-4 text-center">
      <p class="text-white text-sm opacity-80">© 2023 Fiscaliza+. Todos os direitos reservados.</p>
    </div>
  </div>

</body>
</html>
