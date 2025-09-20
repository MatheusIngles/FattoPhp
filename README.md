# FattoPhp - Sistema Lista de Tarefas

## Descrição do Projeto
O **FattoPhp** é um sistema web desenvolvido para gerenciamento de tarefas, permitindo cadastro, edição, exclusão e reordenação de tarefas. Todos os dados são armazenados em um banco de dados MySQL.
O projeto foi desenvolvido como parte do desafio proposto para criação de um sistema de lista de tarefas com funcionalidades completas e ordenação.

---

## Funcionalidades

### 1. Lista de Tarefas
- Página principal do sistema que exibe todas as tarefas cadastradas.
- Tarefas exibidas **ordenadas pelo campo "Ordem de Apresentação"**.
- Exibição de todos os campos, exceto "Ordem de Apresentação".
- Destaque visual para tarefas com custo maior ou igual a R$1.000,00 (linha em fundo amarelo).
- Botões ao lado de cada tarefa:
  - **Editar**: permite alterar Nome, Custo e Data Limite.
  - **Excluir**: permite remover a tarefa com confirmação antes da exclusão.
- Botão para **Incluir** nova tarefa ao final da lista.

### 2. Incluir Tarefa
- Permite criar uma nova tarefa com os campos: Nome da Tarefa, Custo e Data Limite.
- "Ordem de Apresentação" é gerada automaticamente, adicionando a tarefa no final da lista.
- Não permite duplicidade de nomes de tarefa.

### 3. Editar Tarefa
- Permite alterar Nome, Custo e Data Limite de uma tarefa existente.
- Verifica se o novo nome da tarefa já existe, impedindo duplicidade.
- Pode ser implementado via:
  1. Edição direta na tela principal.
  2. Popup ou nova tela para edição dos campos.

### 4. Excluir Tarefa
- Remove uma tarefa específica do banco de dados.
- Exige confirmação do usuário antes da exclusão (Sim/Não).

### 5. Reordenação de Tarefas
- Permite alterar a **Ordem de Apresentação** das tarefas.
- Implementação pode ser feita de duas formas:
  1. **Drag-and-drop**: o usuário arrasta a tarefa para a posição desejada.
  2. **Botões "Subir" e "Descer"**: alteram a posição da tarefa, respeitando limites (primeira não sobe, última não desce).

---

## Estrutura do Banco de Dados

**Tabela: `tarefas`**

| Campo                  | Tipo          | Observações                        |
|------------------------|--------------|-----------------------------------|
| id                     | INT          | Chave primária                     |
| nome                   | VARCHAR(255) | Nome da tarefa, único              |
| custo                  | DECIMAL(10,2)| Custo da tarefa                    |
| data_limite            | DATE         | Data limite                        |
| ordem_de_apresentacao  | INT          | Ordem de exibição, valor único     |

---

## Tecnologias Utilizadas
- **Back-end:** PHP 
- **Banco de Dados:** MySQL
- **Front-end:** HTML5, CSS3, JavaScript, Bootstrap
- **Servidor Local:** XAMPP / Apache

---

## Como Executar o Projeto

1. Clone este repositório:
   ```bash
   git clone https://github.com/MatheusIngles/FattoPhp.git
