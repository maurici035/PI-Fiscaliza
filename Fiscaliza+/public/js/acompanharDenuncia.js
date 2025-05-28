  document.getElementById("toggleFilterBtn").addEventListener("click", () => {
    const dropdown = document.getElementById("filtersDropdown");
    dropdown.style.display = dropdown.style.display === "none" ? "flex" : "none";
  });

  document.getElementById('filterSelect').addEventListener('change', function () {
    const selected = this.value;
    document.querySelectorAll('.section-title').forEach(title => {
      const section = title.getAttribute('data-section');
      const grid = document.querySelector(`[data-grid="${section}"]`);
      if (selected === 'all' || selected === section) {
        title.style.display = 'block';
        grid.style.display = 'grid';
      } else {
        title.style.display = 'none';
        grid.style.display = 'none';
      }
    });
  });

  document.querySelectorAll('.view-button').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      window.location.href = `visualizar-denuncia.html?id=${id}`;
    });
  });