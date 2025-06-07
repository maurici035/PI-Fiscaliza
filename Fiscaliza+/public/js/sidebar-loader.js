document.addEventListener('DOMContentLoaded', function () {
    function loadSidebar() {
        const sidebarContainer = document.getElementById('sidebar-container');

        if (!sidebarContainer) {
            console.error('Elemento com ID "sidebar-container" não encontrado');
            return;
        }

        fetch('/templates/sidebar.blade.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Falha ao carregar a sidebar: ' + response.status);
                }
                return response.text();
            })
            .then(html => {
                sidebarContainer.innerHTML = html;

                const navLinks = sidebarContainer.querySelectorAll('.nav-link');

                navLinks.forEach((link, index) => {
                    // Garante que o primeiro link (logo) esteja sempre inativo
                    if (index === 0) {
                        link.classList.remove('active');
                        return; // pula o resto da lógica para o logo
                    }

                    // Ativa automaticamente o ícone da página atual
                    const currentPage = window.location.pathname.split('/').pop();
                    if (
                        link.getAttribute('href') &&
                        link.getAttribute('href').includes(currentPage)
                    ) {
                        link.classList.add('active');
                    }

                    // Evento de clique
                    link.addEventListener('click', function (e) {
                        navLinks.forEach((item, idx) => {
                            item.classList.remove('active');
                            // Garante que o logo continue inativo
                            if (idx === 0) {
                                item.classList.remove('active');
                            }
                        });

                        this.classList.add('active');
                    });
                });
            })
            .catch(error => {
                console.error('Erro ao carregar a sidebar:', error);
                sidebarContainer.innerHTML = '<p>Erro ao carregar a barra lateral</p>';
            });
    }

    loadSidebar();
});
