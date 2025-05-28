let selectedRating = 0;
const stars = document.querySelectorAll('.star');

stars.forEach(star => {
    star.addEventListener('mouseover', () => {
        const val = parseInt(star.dataset.value);
        highlightStars(val);
    });

    star.addEventListener('mouseout', () => {
        highlightStars(selectedRating);
    });

    star.addEventListener('click', () => {
        selectedRating = parseInt(star.dataset.value);
        highlightStars(selectedRating);
    });
});

function highlightStars(val) {
    stars.forEach(star => {
        if (parseInt(star.dataset.value) <= val) {
            star.classList.add('selected');
        } else {
            star.classList.remove('selected');
        }
    });
}

function resetStars() {
    highlightStars(0);
}

function enviarAvaliacao() {
    const comentario = document.getElementById('comentario').value.trim();
    const botao = document.querySelector('button');

    const existente = document.getElementById('feedback-msg');
    if (existente) existente.remove();

    if (selectedRating === 0 || comentario.length < 5) {
        const msg = document.createElement('div');
        msg.id = 'feedback-msg';
        msg.style.marginTop = '10px';
        msg.style.color = 'red';
        msg.textContent = "Por favor, selecione uma nota e escreva um comentário com pelo menos 5 caracteres.";
        botao.insertAdjacentElement('afterend', msg);
        return;
    }

    botao.disabled = true;
    botao.textContent = "Enviando...";

    setTimeout(() => {
        selectedRating = 0;
        resetStars();
        document.getElementById('comentario').value = '';
        botao.disabled = false;
        botao.textContent = "Enviar Avaliação";

        const msg = document.createElement('div');
        msg.id = 'feedback-msg';
        msg.style.marginTop = '10px';
        msg.style.color = 'green';
        msg.textContent = "Avaliação enviada com sucesso!";
        botao.insertAdjacentElement('afterend', msg);
    }, 2000);
}

document.addEventListener('touchmove', function (e) {
    if (!e.target.closest('.main-content')) {
        e.preventDefault();
    }
}, { passive: false });

document.addEventListener('wheel', function (e) {
    if (!e.target.closest('.main-content') && !e.ctrlKey) {
        e.preventDefault();
    }
}, { passive: false });