import { ITarefa } from "./tarefa.interface";

export class Tarefa implements ITarefa {
    id: number;
    titulo: string;
    descricao: string;
    concluido_em: Date | null;
    status: 'Pendente' | 'Em Andamento' | 'Concluida';
    created_at: string;
    updated_at: string;
  
    constructor(
      id: number,
      titulo: string,
      descricao: string,
      status: 'Pendente' | 'Em Andamento' | 'Concluida',
      concluido_em: Date | null = null,
      created_at: string,
      updated_at: string
    ) {
      this.id = id;
      this.titulo = titulo;
      this.descricao = descricao;
      this.status = status;
      this.concluido_em = concluido_em;
      this.created_at = created_at;
      this.updated_at = updated_at;
    }
  
    // // Método para formatar a data de conclusão
    // getFormattedConcluidoEm(): string {
    //   return this.concluido_em ? this.concluido_em.toLocaleString() : 'Ainda não concluída';
    // }
  
    // // Exemplo de método para alterar o status
    // setStatus(status: 'pendente' | 'em_andamento' | 'completada'): void {
    //   this.status = status;
    // }
  
    // // Método para concluir a tarefa
    // concluirTarefa(): void {
    //   this.status = 'completada';
    //   this.concluido_em = new Date();
    // }
  }
  