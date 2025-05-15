<?php

fetch('salvar_denuncia.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({
        titulo: 'Buraco na rua',
        descricao: 'Bem na esquina com a Av. Brasil',
        latitude: lat,
        longitude: lng
    })
})
.then(res => res.text())
.then(response => {
    alert('Denúncia enviada: ' + response);
});

?>