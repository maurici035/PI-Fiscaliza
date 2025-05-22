 // Estado da aplicação
    let currentFilter = 'todos';
    let currentSort = 'rating-desc';
    let selectedRating = 0;
    let currentOrgao = '';

    // Dados dos órgãos
    const orgaosData = {
      'Secretaria Municipal de Obras e Infraestrutura-RJ': {
        category: 'obras',
        rating: 4.2,
        responseTime: 3,
        details: 'Responsável por obras públicas, manutenção de vias e infraestrutura urbana.'
      },
      'Secretaria Municipal do Meio Ambiente-RS': {
        category: 'meio-ambiente',
        rating: 3.5,
        responseTime: 5,
        details: 'Atua na preservação ambiental, licenciamento e fiscalização ambiental.'
      },
      'Secretaria Municipal de Trânsito e Transportes-BA': {
        category: 'transito',
        rating: 3.2,
        responseTime: 7,
        details: 'Gerencia o trânsito urbano, transporte público e sinalização.'
      },
      'Cagece-Ce': {
        category: 'saneamento',
        rating: 3.2,
        responseTime: 11,
        details: 'Companhia de água e esgoto responsável pelo saneamento básico.'
      }
    };

    // Inicialização
    document.addEventListener('DOMContentLoaded', function() {
      setupEventListeners();
      loadSavedPreferences();
    });

    function setupEventListeners() {
      // Dropdown toggles
      document.getElementById('filterBtn').addEventListener('click', function(e) {
        e.stopPropagation();
        toggleDropdown('filterDropdown');
      });

      document.getElementById('orderBtn').addEventListener('click', function(e) {
        e.stopPropagation();
        toggleDropdown('orderDropdown');
      });

      // Modal stars
      const modalStars = document.querySelectorAll('.modal-star');
      modalStars.forEach(star => {
        star.addEventListener('click', function() {
          selectedRating = parseInt(this.dataset.rating);
          updateModalStars();
        });

        star.addEventListener('mouseenter', function() {
          const rating = parseInt(this.dataset.rating);
          highlightStars(rating);
        });
      });

      document.getElementById('modalStars').addEventListener('mouseleave', function() {
        updateModalStars();
      });

      // Fechar dropdowns ao clicar fora
      document.addEventListener('click', function() {
        closeAllDropdowns();
      });

      // Fechar modal ao clicar fora
      document.getElementById('ratingModal').addEventListener('click', function(e) {
        if (e.target === this) {
          closeRatingModal();
        }
      });
    }

    function toggleDropdown(dropdownId) {
      closeAllDropdowns();
      const dropdown = document.getElementById(dropdownId).parentElement;
      dropdown.classList.toggle('show');
    }

    function closeAllDropdowns() {
      const dropdowns = document.querySelectorAll('.dropdown');
      dropdowns.forEach(dropdown => {
        dropdown.classList.remove('show');
      });
    }

    // Filtros
    function filterByCategory(category) {
      currentFilter = category;
      updateFilterButton();
      applyFiltersAndSort();
      closeAllDropdowns();
      savePreferences();
    }

    function updateFilterButton() {
      const filterBtn = document.getElementById('filterBtn');
      const categoryNames = {
        'todos': 'Todos',
        'obras': 'Obras e Infraestrutura',
        'meio-ambiente': 'Meio Ambiente',
        'transito': 'Trânsito e Transportes',
        'saneamento': 'Saneamento'
      };
      filterBtn.textContent = `Filtro: ${categoryNames[currentFilter]}`;
    }

    // Ordenação
    function sortBy(criteria) {
      currentSort = criteria;
      updateSortButton();
      applyFiltersAndSort();
      closeAllDropdowns();
      savePreferences();
    }

    function updateSortButton() {
      const orderBtn = document.getElementById('orderBtn');
      const sortNames = {
        'rating-desc': 'Maior Nota',
        'rating-asc': 'Menor Nota',
        'response-asc': 'Resposta Mais Rápida',
        'response-desc': 'Resposta Mais Lenta',
        'name-asc': 'Nome A-Z',
        'name-desc': 'Nome Z-A'
      };
      orderBtn.textContent = `Ordenar por: ${sortNames[currentSort]}`;
    }

    function applyFiltersAndSort() {
      const orgaoList = document.getElementById('orgaoList');
      const items = Array.from(orgaoList.children);

      // Filtrar
      items.forEach(item => {
        const category = item.dataset.category;
        if (currentFilter === 'todos' || category === currentFilter) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });

      // Ordenar apenas itens visíveis
      const visibleItems = items.filter(item => item.style.display !== 'none');
      
      visibleItems.sort((a, b) => {
        switch (currentSort) {
          case 'rating-desc':
            return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
          case 'rating-asc':
            return parseFloat(a.dataset.rating) - parseFloat(b.dataset.rating);
          case 'response-asc':
            return parseInt(a.dataset.response) - parseInt(b.dataset.response);
          case 'response-desc':
            return parseInt(b.dataset.response) - parseInt(a.dataset.response);
          case 'name-asc':
            return a.dataset.name.localeCompare(b.dataset.name);
          case 'name-desc':
            return b.dataset.name.localeCompare(a.dataset.name);
          default:
            return 0;
        }
      });

      // Reordenar no DOM
      visibleItems.forEach(item => orgaoList.appendChild(item));
      
      // Adicionar animação
      items.forEach((item, index) => {
        if (item.style.display !== 'none') {
          item.style.animation = `fadeInUp 0.5s ease ${index * 0.1}s both`;
        }
      });
    }

    // Detalhes do órgão
    function showDetails(orgaoName) {
      const orgao = orgaosData[orgaoName];
      if (orgao) {
        alert(`Detalhes: ${orgaoName}\n\n${orgao.details}\n\nAvaliação: ${orgao.rating}/5\nTempo de resposta: ${orgao.responseTime} dias`);
      }
    }

    // Modal de avaliação
    function openRatingModal(orgaoName) {
      currentOrgao = orgaoName;
      selectedRating = 0;
      document.getElementById('orgaoName').textContent = orgaoName;
      updateModalStars();
      document.getElementById('ratingModal').style.display = 'block';
      document.body.style.overflow = 'hidden';
    }

    function closeRatingModal() {
      document.getElementById('ratingModal').style.display = 'none';
      document.body.style.overflow = 'auto';
      selectedRating = 0;
      currentOrgao = '';
    }

    function updateModalStars() {
      const stars = document.querySelectorAll('.modal-star');
      stars.forEach((star, index) => {
        if (index < selectedRating) {
          star.classList.add('filled');
        } else {
          star.classList.remove('filled');
        }
      });
    }

    function highlightStars(rating) {
      const stars = document.querySelectorAll('.modal-star');
      stars.forEach((star, index) => {
        if (index < rating) {
          star.style.color = '#FFD700';
        } else {
          star.style.color = '#CCCCCC';
        }
      });
    }

    function submitRating() {
      if (selectedRating === 0) {
        alert('Por favor, selecione uma avaliação antes de confirmar.');
        return;
      }

      // Simular envio da avaliação
      alert(`Avaliação enviada com sucesso!\n\nÓrgão: ${currentOrgao}\nNota: ${selectedRating}/5 estrelas\n\nObrigado por sua contribuição!`);
      
      // Aqui você enviaria os dados para o servidor
      console.log('Avaliação enviada:', {
        orgao: currentOrgao,
        rating: selectedRating,
        timestamp: new Date().toISOString()
      });

      closeRatingModal();
    }

    // Persistência de preferências
    function savePreferences() {
      const preferences = {
        filter: currentFilter,
        sort: currentSort
      };
      // Em ambiente real, usaria localStorage
      // localStorage.setItem('fiscaliza-preferences', JSON.stringify(preferences));
    }

    function loadSavedPreferences() {
      // Em ambiente real, carregaria do localStorage
      // const saved = localStorage.getItem('fiscaliza-preferences');
      // if (saved) {
      //   const preferences = JSON.parse(saved);
      //   currentFilter = preferences.filter || 'todos';
      //   currentSort = preferences.sort || 'rating-desc';
      // }
      
      updateFilterButton();
      updateSortButton();
      applyFiltersAndSort();
    }

    // Animações CSS adicionais
    const style = document.createElement('style');
    style.textContent = `
      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .orgao-item {
        animation: fadeInUp 0.5s ease both;
      }
    `;
    document.head.appendChild(style);

    // Easter egg - Konami Code
    let konamiCode = [];
    const correctCode = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];
    
    document.addEventListener('keydown', function(e) {
      konamiCode.push(e.keyCode);
      if (konamiCode.length > correctCode.length) {
        konamiCode.shift();
      }
      
      if (JSON.stringify(konamiCode) === JSON.stringify(correctCode)) {
        alert('🎉 Código Konami ativado! Você descobriu o Easter Egg do Fiscaliza+!');
        document.body.style.animation = 'rainbow 2s infinite';
      }
    });

    const rainbowStyle = document.createElement('style');
    rainbowStyle.textContent = `
      @keyframes rainbow {
        0% { filter: hue-rotate(0deg); }
        100% { filter: hue-rotate(360deg); }
      }
    `;
    document.head.appendChild(rainbowStyle);