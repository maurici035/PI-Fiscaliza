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
    
    #sugestoes-container {
        position: relative;
    }

    #sugestoes {
        position: absolute;
        width: 100%;
        z-index: 20;
        background-color: white; /* Garante fundo branco */
        border: 1px solid #e5e7eb; /* Equivalente a border-gray-200 */
        margin-top: 0.25rem; /* mt-1 */
        max-height: 15.5rem; 
        overflow-y: auto;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        display: none; /* Inicia escondido */
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
          <h2 class="text-3xl font-semibold text-gray-800 mb-2">Empresa</h2>
          <h2 class="text-2xl font-bold text-dark">Cadastre-se</h2>
        </div>


        <form action="{{route('empresa.store')}}" method="POST">
          @csrf

          <div class="space-y-4">
            <div>
              <input type="text" name="nome" placeholder="Nome da empresa" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            </div>
            
            <div>
              <input type="email" name="email" placeholder="E-mail" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            </div>

            <div>
              <input type="password" name="senha" placeholder="Senha" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            </div>
            <div>
              <input type="password" name="senha_confirmation" placeholder="Repita a Senha" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
            </div>
            <div>
                <label for="tipo_servico" class="block mb-2 text-sm font-medium text-gray-700">Tipo de serviço:</label>
                <select name="tipo_servico" id="tipo_servico" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition">
                    <option value="">Selecione</option>
                    <option value="Água">Água</option>
                    <option value="Energia">Energia</option>
                    <option value="Iluminação pública">Iluminação pública</option>
                </select>
            </div>

            <div id="sugestoes-container">
                <label for="cidade" class="block mb-2 text-sm font-medium text-gray-700">Cidade:</label>
                <input type="text" id="cidade" name="cidade" autocomplete="off" 
                       placeholder="Carregando cidades..." disabled
                       class="w-full px-4 py-3 bg-gray-200 border border-gray-200 rounded-xl transition cursor-not-allowed">
                <ul id="sugestoes"></ul>
            </div>

            <div class="flex items-center space-x-2 pt-2">
              <input type="checkbox" name="terms" required id="terms" class="accent-primary w-4 h-4">
              <label for="terms" class="text-sm text-gray-600">
                Li, entendi e concordo com os <a href="#" class="text-blue-600 hover:underline">Termos e Condições</a>.
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
          <a href="{{route('login')}}" class="text-primary font-medium hover:text-secondary transition">Entrar</a>
        </p>
      </div>
    </div>
  </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const inputCidade = document.getElementById('cidade');
    const sugestoesList = document.getElementById('sugestoes');
    let todasAsCidades = [];

    async function carregarCidades() {
        const url = 'https://servicodados.ibge.gov.br/api/v1/localidades/municipios?orderBy=nome';
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Falha ao carregar os dados do IBGE.');
            }
            const data = await response.json();
            
            todasAsCidades = data.map(municipio => {
                // *** AQUI ESTÁ A CORREÇÃO ***
                // Usamos optional chaining (?.) para acessar dados aninhados de forma segura.
                // Se qualquer parte do caminho não existir, ele retorna undefined em vez de um erro.
                // O `|| 'N/A'` garante um valor padrão caso o estado não seja encontrado.
                const estado = municipio.microrregiao?.mesorregiao?.UF?.sigla || 'N/A';

                return {
                    nome: municipio.nome,
                    estado: estado
                };
            });
            
            inputCidade.disabled = false;
            inputCidade.placeholder = 'Digite o nome da cidade';
            inputCidade.classList.remove('bg-gray-200', 'cursor-not-allowed');
            inputCidade.classList.add('bg-gray-50');

        } catch (error) {
            console.error("Erro ao carregar ou processar cidades:", error);
            inputCidade.placeholder = 'Erro ao carregar cidades';
            // Deixa o campo vermelho para indicar um erro crítico
            inputCidade.classList.add('border-red-500', 'text-red-700');
        }
    }

    function mostrarSugestoes() {
        const termo = inputCidade.value.trim().toLowerCase();
        sugestoesList.innerHTML = '';

        if (termo.length < 3) {
            sugestoesList.style.display = 'none';
            return;
        }

        const cidadesFiltradas = todasAsCidades.filter(cidade =>
            cidade.nome.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").includes(termo)
        );

        const sugestoesLimitadas = cidadesFiltradas.slice(0, 10);

        if (sugestoesLimitadas.length === 0) {
            sugestoesList.style.display = 'none';
            return;
        }

        sugestoesLimitadas.forEach(cidade => {
            const item = document.createElement('li');
            item.textContent = `${cidade.nome}, ${cidade.estado}`;
            item.className = 'p-3 cursor-pointer hover:bg-primary hover:text-white transition-colors duration-150';
            
            item.addEventListener('click', () => {
                inputCidade.value = cidade.nome;
                sugestoesList.style.display = 'none';
            });

            sugestoesList.appendChild(item);
        });

        sugestoesList.style.display = 'block';
    }

    inputCidade.addEventListener('input', mostrarSugestoes);

    document.addEventListener('click', (event) => {
        if (!event.target.closest('#sugestoes-container')) {
            sugestoesList.style.display = 'none';
        }
    });

    carregarCidades();
});
</script>

</body>
</html>