new Sortable(document.getElementById("tabela-tarefas"), {
      handle: ".drag-handle",
      animation: 150,
    });

    const modalExcluir = document.getElementById('modalExcluir');
    modalExcluir.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const nome = button.getAttribute('data-nome');
      modalExcluir.querySelector('#tarefaNome').textContent = nome;
      modalExcluir.querySelector('#tarefaId').value = id;
    });

function salvarOrdem(){
  const ordem = document.getElementById('tabela-tarefas').children;
  const ordemSalva = Array.from(ordem).map(tarefa => tarefa.getAttribute('data-id'));
  const formData = new FormData();
  ordemSalva.forEach((id, index) => {
    formData.append('ordem[]', id);
  });

  fetch('salvar.php', {
    method: 'POST',
    body: formData
  }).then(response => {
    if (response.ok) {
      console.log('Ordem salva com sucesso!');
    } else {
      console.error('Erro ao salvar ordem:', response.statusText);
    }
  }).catch(error => {
    console.error('Erro ao salvar ordem:', error);
  });
}



document.addEventListener('DOMContentLoaded', function () {
  const modalEditar = document.getElementById('modalEditar');

  modalEditar.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const id = button.getAttribute('data-id');
    const nome = button.getAttribute('data-nome');
    const custo = button.getAttribute('data-custo');
    const data = button.getAttribute('data-data');

    modalEditar.querySelector('input[name="id"]').value = id;
    modalEditar.querySelector('input[name="NomeDaTarefa"]').value = nome;
    modalEditar.querySelector('input[name="Custo"]').value = custo;
    modalEditar.querySelector('input[name="DataLimite"]').value = data;
  });
});
