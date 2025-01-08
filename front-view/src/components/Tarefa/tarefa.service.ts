import axios from 'axios';

const API_URL = 'http://localhost:8000/api/tarefas';

export const getTarefas = async () => {
  try {
    const response = await axios.get(API_URL);
    return response.data;
  } catch (error) {
    console.error('Erro ao obter tarefas:', error);
    throw error;
  }
};


export const createTarefa = async (tarefa: { titulo: string; descricao: string }) => {
  try {
    const response = await axios.post(`${API_URL}/store`, { tarefa });
    return response.data;
  } catch (error) {
    console.error('Erro ao criar tarefa:', error);
    throw error;
  }
};


export const updateTarefa = async (
  id: number,
  tarefa: { titulo: string; descricao: string; status: string }
) => {
  try {
    const response = await axios.put(`${API_URL}/${id}`, { tarefa });
    return response.data;
  } catch (error) {
    console.error('Erro ao atualizar tarefa:', error);
    throw error;
  }
};


export const deleteTarefa = async (id: number) => {
  try {
    const response = await axios.delete(`${API_URL}/${id}`);
    return response.data;
  } catch (error) {
    console.error('Erro ao excluir tarefa:', error);
    throw error;
  }
};
