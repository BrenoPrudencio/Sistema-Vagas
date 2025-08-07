<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Candidatos</title>
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
                <h3>Filtros de Busca</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('candidatos.index') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-10">
                            <label for="search" class="form-label">Buscar por Nome ou Email</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Digite um nome ou email...">
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
            <h1>Lista de Candidatos</h1>
            <a href="{{ route('candidatos.create') }}" class="btn btn-success">Novo Candidato</a>
        </div>

        {{-- Tabela de Candidatos --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($candidatos as $candidato)
                        <tr>
                            <td>{{ $candidato->id }}</td>
                            <td>{{ $candidato->nome }}</td>
                            <td>{{ $candidato->email }}</td>
                            <td>{{ $candidato->telefone_formatado }}</td>
                            <td>
                                <a href="{{ route('candidatos.edit', $candidato->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('candidatos.destroy', $candidato->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este candidato?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhum candidato encontrado com os filtros aplicados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div class="d-flex justify-content-center">
            {!! $candidatos->links('pagination::bootstrap-5') !!}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>