<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscaliza+</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('assets/logo-menor.png') }}" type="image/png">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('assets/fiscaliza-logo.png') }}" alt="Fiscaliza+ Logo">
        </div>
        <div class="buttons">
            <a href="{{route('typeuser')}}">
                <button class="btn-create">Cadastrar</button>
            </a>
            <a href="{{route('typeuserlogin')}}">
                <button class="btn-login">Entrar</button>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="content-container">
            <div class="content">
                <h1>Fiscalize sua cidade</h1>
                <p>Encontre buracos nas ruas, falta de iluminação pública, vazamentos de água ou outros problemas na sua
                    cidade? Denuncie aqui!</p>
                <p>Com o Fiscaliza+, você pode reportar falhas na infraestrutura da cidade de forma rápida e fácil.</p>
            </div>
            <div class="image-container">
                <img src="{{ asset('assets/pessoas-no-celular.png') }}" alt="Pessoas usando celular">
            </div>
        </div>
    </div>
</body>

</html>