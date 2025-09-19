new Sortable(document.getElementById("tabela-tarefas"), {
      handle: ".drag-handle",
      animation: 150,
      onEnd: function (evt) {
        console.log("Nova ordem:", Array.from(evt.to.children).map(tr => tr.cells[1].innerText));
      }
    });

    const modalExcluir = document.getElementById('modalExcluir');
    modalExcluir.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const nome = button.getAttribute('data-nome');
      modalExcluir.querySelector('#tarefaNome').textContent = nome;
      modalExcluir.querySelector('#tarefaId').value = id;
    });