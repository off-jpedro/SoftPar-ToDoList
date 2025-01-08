<template>
  <q-page class="q-pa-md flex flex-center" style="width: 100%; height: 100%;">
    <div class="text-h4 text-center q-mb-none">
      <strong>Lista de Tarefas</strong>
    </div>

    <q-card style="width: 100%; max-width: 100%; padding: 0;">
      <q-card-section class="q-pa-none">
        <!-- Filtros -->
        <div class="q-gutter-md row items-center q-px-md">
          <!-- Filtro por Título -->
          <div class="col-12 col-md-6">
            <q-input
              square
              outlined
              v-model="searchQuery"
              label="Filtrar Tarefas"
              debounce="300"
              dense
              placeholder="Pesquise pelo título"
            />
          </div>

          <!-- Filtro por Status -->
          <div class="col-12 col-md-3">
            <q-select
              filled
              v-model="selectedStatus"
              :options="statusOptionsWithAll"
              label="Status"
              dense
              emit-value
              map-options
            />
          </div>

          <!-- Botão de Nova Tarefa -->
          <div class="col-12 col-md-auto">
            <q-btn 
              label="Nova Tarefa" 
              icon="add_circle" 
              color="primary" 
              @click="openAddModal"
            />
          </div>
        </div>
      </q-card-section>

      <!-- Tabela de Tarefas -->
      <div class="q-pa-md">
        <q-markup-table bordered>
    <thead>
      <tr>
        <th class="text-left" @click="sortByColumn('titulo')">
          Tarefas
          <q-icon :name="sortColumn === 'titulo' ? (sortOrder === 'asc' ? 'arrow_upward' : 'arrow_downward') : ''" size="xs" />
        </th>
        <th class="text-left" @click="sortByColumn('created_at')">
          Data Criação
          <q-icon :name="sortColumn === 'created_at' ? (sortOrder === 'asc' ? 'arrow_upward' : 'arrow_downward') : ''" size="xs" />
        </th>
        <th class="text-left" @click="sortByColumn('concluido_em')">
          Data Conclusão
          <q-icon :name="sortColumn === 'concluido_em' ? (sortOrder === 'asc' ? 'arrow_upward' : 'arrow_downward') : ''" size="xs" />
        </th>
        <th class="text-right" @click="sortByColumn('status')">
          Status
          <q-icon :name="sortColumn === 'status' ? (sortOrder === 'asc' ? 'arrow_upward' : 'arrow_downward') : ''" size="xs" />
        </th>
        <th class="text-center">Ações</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(tarefa, index) in filteredTarefas" :key="tarefa.id">
        <td class="text-left">{{ tarefa.titulo }}</td>
        <td class="text-left">{{ formatDate(tarefa.created_at) }}</td>
        <td class="text-left">{{ formatDate(tarefa.concluido_em || ' ') }}</td>
        <td class="text-right">{{ tarefa.status }}</td>
        <td class="text-center">
          <q-btn
            flat
            :icon="tarefa.status === 'Concluida' ? 'check_circle' : 'edit'"
            :color="tarefa.status === 'Concluida' ? 'green' : 'primary'"
            @click.stop="openEditModal(tarefa)"
            class="q-mr-sm"
          />
          <q-btn
            flat
            icon="delete"
            color="negative"
            @click.stop="confirmDelete(tarefa.id, tarefa.titulo)"
          />
        </td>
      </tr>
      <!-- Caso não haja tarefas a exibir -->
      <tr v-if="filteredTarefas.length === 0">
        <td colspan="5" class="text-center">Nenhuma tarefa encontrada</td>
      </tr>
    </tbody>
  </q-markup-table>
      </div>

      <!-- Modal de Edição -->
      <q-dialog v-model="isEditModalOpen">
        <q-card>
          <q-card-section>
            <div class="text-h6">Editar Tarefa</div>
            <q-input v-model="editTarefaData.titulo" label="Título" />
            <q-input v-model="editTarefaData.descricao" label="Descrição" />
            <q-select
              v-model="editTarefaData.status"
              :options="statusOptions"
              label="Status"
              filled
            />
          </q-card-section>
          <q-card-actions>
            <q-btn flat label="Cancelar" @click="closeEditModal" />
            <q-btn flat label="Salvar" color="primary" @click="saveEditTarefa" />
          </q-card-actions>
        </q-card>
      </q-dialog>

      <!-- Modal de Adição -->
      <q-dialog v-model="isAddModalOpen">
        <q-card>
          <q-card-section>
            <div class="text-h6">Adicionar Tarefa</div>
            <q-input v-model="newTarefaData.titulo" label="Título" />
            <q-input v-model="newTarefaData.descricao" label="Descrição" />
            <q-select
              v-model="newTarefaData.status"
              :options="statusOptions"
              label="Status"
              filled
            />
          </q-card-section>
          <q-card-actions>
            <q-btn flat label="Cancelar" @click="closeAddModal" />
            <q-btn flat label="Salvar" color="primary" @click="saveAddTarefa" />
          </q-card-actions>
        </q-card>
      </q-dialog>

      <!-- Modal de Exclusão -->
      <q-dialog v-model="isDeleteDialogOpen">
        <q-card>
          <q-card-section>
            <div class="text-h6">Confirmar Exclusão</div>
            <div>Você realmente deseja excluir a tarefa "{{ deleteTarefaTitle }}"?</div>
          </q-card-section>
          <q-card-actions>
            <q-btn flat label="Cancelar" @click="closeDeleteDialog" />
            <q-btn flat label="Excluir" color="negative" @click="confirmDeleteTarefa" />
          </q-card-actions>
        </q-card>
      </q-dialog>
    </q-card>
  </q-page>
</template>

<script>
import { useQuasar } from 'quasar';
import { getTarefas, createTarefa, updateTarefa, deleteTarefa as deleteTarefaService } from 'src/components/Tarefa/tarefa.service';
import { ref, onMounted, computed } from 'vue';

export default {
  name: 'TarefasListPage',
  setup() {
    const $q = useQuasar();
    const tarefas = ref([]);
    const isEditModalOpen = ref(false);
    const isAddModalOpen = ref(false);
    const isDeleteDialogOpen = ref(false);
    const deleteTarefaId = ref(null);
    const deleteTarefaTitle = ref('');
    const editTarefaData = ref({
      id: null,
      titulo: '',
      descricao: '',
      status: '',
    });
    const newTarefaData = ref({
      titulo: '',
      descricao: '',
      status: 'Pendente',
    });

    // Defina 'sortColumn' como uma referência
    const sortColumn = ref('');
    const sortOrder = ref('asc');  // Ordenação inicial

    const sortByColumn = (column) => {
      if (sortColumn.value === column) {
        // Se a mesma coluna for clicada, inverte a ordem
        sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
      } else {
        // Se uma nova coluna for clicada, ordena por ela de forma ascendente
        sortColumn.value = column;
        sortOrder.value = 'asc';
      }

      tarefas.value.sort((a, b) => {
        let valA = a[column];
        let valB = b[column];

        // Se for uma data, converte para timestamp
        if (column === 'created_at' || column === 'concluido_em') {
          valA = new Date(valA).getTime();
          valB = new Date(valB).getTime();
        }

        // Ordena conforme a ordem especificada
        if (sortOrder.value === 'asc') {
          return valA < valB ? -1 : valA > valB ? 1 : 0;
        } else {
          return valA < valB ? 1 : valA > valB ? -1 : 0;
        }
      });
    };

    const formatDate = (date) => {
      if (!date || isNaN(new Date(date))) return 'Não Concluída';  // Valor padrão quando não há data válida
      const d = new Date(date);
      return d.toLocaleDateString('pt-BR', {
        weekday: 'short',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });
    };

    const statusOptions = ['Pendente', 'Em Andamento', 'Concluida'];
    const statusOptionsWithAll = computed(() => ['Todos', ...statusOptions]);

    const searchQuery = ref('');
    const selectedStatus = ref('Todos');

    // Função para carregar as tarefas
    const loadTarefas = async () => {
      try {
        tarefas.value = await getTarefas();
        $q.notify({
          message: 'Tarefas carregadas com sucesso!',
          color: 'green',
          position: 'top',
        });
      } catch (error) {
        console.error('Erro ao carregar tarefas:', error);
        $q.notify({
          message: 'Erro ao carregar tarefas.',
          color: 'red',
          position: 'top',
        });
      }
    };

    // Função para abrir o modal de criação de tarefa
    const openAddModal = () => {
      newTarefaData.value = {
        titulo: '',
        descricao: '',
        status: 'Pendente',
      };
      isAddModalOpen.value = true;
    };

    // Função para fechar o modal de criação
    const closeAddModal = () => {
      isAddModalOpen.value = false;
    };

    // Função para abrir o modal de edição de tarefa
    const openEditModal = (tarefa) => {
      editTarefaData.value = { ...tarefa };
      isEditModalOpen.value = true;
    };

    // Função para fechar o modal de edição
    const closeEditModal = () => {
      isEditModalOpen.value = false;
    };

    // Função de validação do formulário de nova tarefa
    const validateNewForm = () => {
      return newTarefaData.value.titulo && newTarefaData.value.descricao;
    };

    // Função para salvar a nova tarefa
    const saveAddTarefa = async () => {
      if (!validateNewForm()) return;
      try {
        const newTarefa = await createTarefa(newTarefaData.value);
        tarefas.value.push(newTarefa);
        $q.notify({
          message: 'Tarefa adicionada com sucesso!',
          color: 'green',
          position: 'top',
        });
        closeAddModal();
      } catch (error) {
        console.error('Erro ao adicionar tarefa:', error);
        $q.notify({
          message: 'Erro ao adicionar tarefa.',
          color: 'red',
          position: 'top',
        });
      }
    };

    // Função para salvar a tarefa editada
    const saveEditTarefa = async () => {
      try {
        const updatedTarefa = await updateTarefa(editTarefaData.value.id, editTarefaData.value);
        tarefas.value = tarefas.value.map(t => t.id === updatedTarefa.id ? updatedTarefa : t);
        $q.notify({
          message: 'Tarefa editada com sucesso!',
          color: 'green',
          position: 'top',
        });
        closeEditModal();
      } catch (error) {
        console.error('Erro ao editar tarefa:', error);
        $q.notify({
          message: 'Erro ao editar tarefa.',
          color: 'red',
          position: 'top',
        });
      }
    };

    // Função para confirmar a exclusão de tarefa
    const confirmDelete = (id, titulo) => {
      deleteTarefaId.value = id;
      deleteTarefaTitle.value = titulo;
      isDeleteDialogOpen.value = true;
    };

    // Função para excluir a tarefa
    const confirmDeleteTarefa = async () => {
      try {
        await deleteTarefaService(deleteTarefaId.value);
        tarefas.value = tarefas.value.filter(t => t.id !== deleteTarefaId.value);
        $q.notify({
          message: 'Tarefa deletada com sucesso!',
          color: 'green',
          position: 'top',
        });
        closeDeleteDialog();
      } catch (error) {
        console.error('Erro ao excluir tarefa:', error);
        $q.notify({
          message: 'Erro ao excluir tarefa.',
          color: 'red',
          position: 'top',
        });
      }
    };

    // Função para fechar o diálogo de exclusão
    const closeDeleteDialog = () => {
      isDeleteDialogOpen.value = false;
      deleteTarefaId.value = null;
      deleteTarefaTitle.value = '';
    };

    const filteredTarefas = computed(() => {
      return tarefas.value.filter(tarefa => {
        const matchesTitle = tarefa.titulo.toLowerCase().includes(searchQuery.value.toLowerCase());
        
        const matchesStatus = selectedStatus.value === 'Todos'
          ? true
          : tarefa.status === selectedStatus.value;

        return matchesTitle && matchesStatus;
      });
    });

    onMounted(loadTarefas);

    return {
      tarefas,
      isEditModalOpen,
      isAddModalOpen,
      isDeleteDialogOpen,
      deleteTarefaId,
      deleteTarefaTitle,
      editTarefaData,
      newTarefaData,
      statusOptions,
      searchQuery,
      selectedStatus,
      filteredTarefas,
      statusOptionsWithAll,
      openAddModal,
      closeAddModal,
      sortByColumn,
      sortColumn,
      sortOrder, // Agora também retorna sortOrder
      openEditModal,
      closeEditModal,
      saveAddTarefa,
      saveEditTarefa,
      formatDate,
      confirmDelete,
      confirmDeleteTarefa,
      closeDeleteDialog,
    };
  },
};
</script>


