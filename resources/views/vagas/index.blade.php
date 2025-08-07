<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vagas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Bloco para exibir mensagens de sucesso --}}
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="container mt-5">

        {{-- Formulário de Filtro --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3><i class="fas fa-filter"></i> Filtros de Busca</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('vagas.index') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <label for="search" class="form-label">Buscar por Título</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Ex: Desenvolvedor, Designer...">
                        </div>
                        <div class="col-md-3">
                            <label for="tipo" class="form-label">Tipo de Contratação</label>
                            <select id="tipo" name="tipo" class="form-select">
                                <option value="">Todos os Tipos</option>
                                <option value="CLT" @if(request('tipo') == 'CLT') selected @endif>CLT</option>
                                <option value="PJ" @if(request('tipo') == 'PJ') selected @endif>PJ</option>
                                <option value="Freelancer" @if(request('tipo') == 'Freelancer') selected @endif>Freelancer</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="">Todos</option>
                                <option value="ativa" @if(request('status') == 'ativa') selected @endif>Ativa</option>
                                <option value="pausada" @if(request('status') == 'pausada') selected @endif>Pausada</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Título da Página e Botão de Criar --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Lista de Vagas</h1>
            <a href="{{ route('vagas.create') }}" class="btn btn-success">Criar Nova Vaga</a>
        </div>

        {{-- Tabela de Vagas --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 40%;">Título</th>
                        <th style="width: 20%;">Tipo</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 20%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vagas as $vaga)
                        <tr>
                            <td>{{ $vaga->id }}</td>
                            <td>
                                <a href="{{ route('vagas.show', $vaga->id) }}">{{ $vaga->titulo }}</a>
                            </td>
                            <td>{{ $vaga->tipo_contratacao }}</td>
                            <td><span class="badge bg-{{ $vaga->status == 'ativa' ? 'success' : 'secondary' }}">{{ ucfirst($vaga->status) }}</span></td>
                            <td>
                                <a href="{{ route('vagas.edit', $vaga->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('vagas.destroy', $vaga->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta vaga?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhuma vaga encontrada com os filtros aplicados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div class="d-flex justify-content-center">
            {!! $vagas->links('pagination::bootstrap-5') !!}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>