<template>
  <q-page class="q-pa-none q-gutter-none flex justify-center items-center">
    <!-- Componente TarefaList, agora ele gerencia as tarefas -->
    <TarefaList />
  </q-page>
</template>

<script setup lang="ts">
import TarefaList from 'components/Tarefa/TarefaList.vue';
</script>
