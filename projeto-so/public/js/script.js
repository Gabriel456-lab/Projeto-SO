function confirmarExclusao(id) {
  if (confirm("Tem certeza que deseja excluir esta tarefa?")) {
    window.location.href = "actions.php?action=delete&id=" + id;
  }
}

// Modo dark/light
const toggle = document.getElementById("theme-toggle");

toggle.addEventListener("change", () => {
  // Se o checkbox estiver marcado, ativa o light-theme
  if (toggle.checked) {
    document.body.classList.add("light-theme");
    document.body.classList.remove("dark-theme");
  } else {
    // Se desmarcado, volta para o dark-theme
    document.body.classList.add("dark-theme");
    document.body.classList.remove("light-theme");
  }
});
