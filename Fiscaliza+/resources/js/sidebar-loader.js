document.addEventListener('DOMContentLoaded', function() {
    // Função para carregar a sidebar
    function loadSidebar() {
        const sidebarContainer = document.getElementById('sidebar-container');
        
        // Verificar se o elemento existe
        if (!sidebarContainer) {
            console.error('Elemento com ID "sidebar-container" não encontrado');
            return;
        }
        
        // Usar fetch para carregar o conteúdo do arquivo sidebar.html
        fetch('../templates/sidebar.html')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Falha ao carregar a sidebar: ' + response.status);
                }
                return response.text();
            })
            .then(html => {
                sidebarContainer.innerHTML = html;
            })
            .catch(error => {
                console.error('Erro ao carregar a sidebar:', error);
                sidebarContainer.innerHTML = '<p>Erro ao carregar a barra lateral</p>';
            });
    }
    
    // Chamar a função para carregar a sidebar
    loadSidebar();
});