export interface ITarefa {
    id: number;
    titulo: string;
    descricao: string;
    concluido_em: Date | null;
    status: 'Pendente' | 'Em Andamento' | 'Concluida';
    created_at: string;
    updated_at: string;
  }