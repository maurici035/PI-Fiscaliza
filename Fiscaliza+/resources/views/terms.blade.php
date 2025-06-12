<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
    <title>Termos</title>
</head>
<body>
<style>
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
</style>

<div class="background"></div>

<div class="max-w-4xl mx-auto my-10 p-6 bg-white rounded-2xl shadow-lg border border-gray-200 overflow-y-auto h-[80vh]">
  <a href="{{ route('cadastro') }}" class="inline-block mb-4 text-sm text-blue-600 hover:underline hover:text-blue-800">
    ← Voltar para o cadastro
  </a>

  <h1 class="text-2xl font-bold mb-2">TERMOS E CONDIÇÕES DE USO DA PLATAFORMA FISCALIZA+</h1>
  <p class="text-sm text-gray-500 mb-4">Última atualização: [Data] | Versão: 1.0</p>

  <div class="space-y-6 text-gray-800 text-justify text-sm sm:text-base">
    <div>
      <h2 class="font-semibold text-lg">1. Aceitação dos Termos</h2>
      <p>Ao acessar ou utilizar a plataforma Fiscaliza+ (site, aplicativo móvel ou serviços relacionados), você concorda com estes Termos e Condições e com nossa Política de Privacidade. Se não concordar, não utilize a plataforma.</p>
    </div>

    <div>
      <h2 class="font-semibold text-lg">2. Definições</h2>
      <p><strong>"Plataforma"</strong>: Aplicativo/site Fiscaliza+.</p>
      <p><strong>"Usuário"</strong>: Pessoa física que utiliza a Fiscaliza+.</p>
      <p><strong>"Reporte"</strong>: Informação enviada pelo Usuário sobre problemas urbanos (ex.: buracos, mobiliário danificado).</p>
      <p><strong>"Órgão Público"</strong>: Entidades governamentais parceiras que recebem os reportes.</p>
    </div>

    <div>
      <h2 class="font-semibold text-lg">3. Funcionalidades da Plataforma</h2>
      <ul class="list-disc ml-5">
        <li>Reportar problemas em espaços públicos (vias, praças, parques);</li>
        <li>Acompanhar o status de reportes enviados;</li>
        <li>Visualizar reportes de outros usuários;</li>
        <li>Compartilhar informações com órgãos públicos competentes.</li>
      </ul>
    </div>

    <div>
      <h2 class="font-semibold text-lg">4. Regras de Conduta</h2>
      <p>Ao usar a Fiscaliza+, você concorda:</p>
      <ul class="list-disc ml-5">
        <li>Não enviar conteúdos falsos, caluniosos ou ilegais;</li>
        <li>Não compartilhar dados pessoais de terceiros sem consentimento;</li>
        <li>Não promover discriminação ou violência;</li>
        <li>Verificar a precisão das informações (localização, descrição, foto);</li>
        <li>Não usar a plataforma para fins comerciais ou políticos.</li>
      </ul>
    </div>

    <div>
      <h2 class="font-semibold text-lg">5. Responsabilidades do Usuário</h2>
      <ul class="list-disc ml-5">
        <li>Garantir que os reportes são autênticos;</li>
        <li>Evitar riscos físicos ao coletar dados (ex.: tirar fotos em vias perigosas);</li>
        <li>Respeitar leis locais durante o uso.</li>
      </ul>
    </div>

    <div>
      <h2 class="font-semibold text-lg">6. Privacidade e Dados</h2>
      <p><strong>Dados coletados</strong>: Localização, fotos, descrições de reportes, e-mail (para cadastro).</p>
      <p><strong>Finalidade</strong>: Processar reportes, compartilhar com órgãos públicos e melhorar a plataforma.</p>
      <p><strong>Direitos do Usuário</strong>: Acessar, corrigir ou excluir dados conforme nossa Política de Privacidade.</p>
    </div>

    <div>
      <h2 class="font-semibold text-lg">7. Direitos de Propriedade Intelectual</h2>
      <p><strong>Conteúdos enviados</strong>: Ao publicar um reporte, você autoriza a Fiscaliza+ a usar as informações para os fins da plataforma.</p>
      <p><strong>Plataforma</strong>: O código, design e logotipo da Fiscaliza+ são propriedade exclusiva dos desenvolvedores.</p>
    </div>

    <div>
      <h2 class="font-semibold text-lg">8. Limitação de Responsabilidade</h2>
      <p>A Fiscaliza+ não garante:</p>
      <ul class="list-disc ml-5">
        <li>A resolução dos problemas reportados;</li>
        <li>A precisão de informações de terceiros (órgãos públicos, usuários);</li>
        <li>Disponibilidade ininterrupta da plataforma.</li>
      </ul>
      <p>Não nos responsabilizamos por danos decorrentes de problemas não resolvidos ou uso indevido da plataforma por usuários.</p>
    </div>

    <div>
      <h2 class="font-semibold text-lg">9. Parcerias com Órgãos Públicos</h2>
      <p>Os reportes são encaminhados automaticamente às autoridades competentes, mas:</p>
      <ul class="list-disc ml-5">
        <li>Não controlamos prazos ou ações desses órgãos;</li>
        <li>Não temos vínculo formal com governos, salvo parcerias explícitas.</li>
      </ul>
    </div>

    <div>
      <h2 class="font-semibold text-lg">10. Rescisão e Suspensão</h2>
      <p>Podemos suspender ou encerrar contas que:</p>
      <ul class="list-disc ml-5">
        <li>Violarem estes Termos;</li>
        <li>Enviarem informações fraudulentas;</li>
        <li>Comprometerem a segurança da plataforma.</li>
      </ul>
    </div>

    <div>
      <h2 class="font-semibold text-lg">11. Modificações nos Termos</h2>
      <p>Reservamo-nos o direito de alterar estes Termos. Alterações serão comunicadas por e-mail ou via plataforma.</p>
    </div>

    <div>
      <h2 class="font-semibold text-lg">12. Lei Aplicável</h2>
      <p>Estes Termos são regidos pelas leis do Brasil. Eventuais disputas serão resolvidas no foro de [Cidade-Estado sede da empresa].</p>
    </div>

    <div>
      <h2 class="font-semibold text-lg">13. Contato</h2>
      <p>Dúvidas sobre estes Termos?<br>Entre em contato: <a href="mailto:fiscalizamais@contato.com" class="text-blue-600 hover:underline">fiscalizamais@contato.com</a></p>
    </div>

    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md">
      <strong class="block mb-1">⚠️ AVISO LEGAL IMPORTANTE:</strong>
      <p>Este documento é um modelo simplificado. Consulte um advogado para:</p>
      <ul class="list-disc ml-5 mt-1">
        <li>Adequação à LGPD (Lei Geral de Proteção de Dados);</li>
        <li>Regras específicas de municípios/estados;</li>
        <li>Responsabilidade civil em casos de informações imprecisas.</li>
      </ul>
      <p class="mt-1">Mantenha uma Política de Privacidade em conformidade.</p>
    </div>
  </div>
</div>
</body>
</html>
