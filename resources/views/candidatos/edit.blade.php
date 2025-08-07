<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Candidato - {{ $candidato->nome }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Candidato</h1>
        <hr>

        {{-- Bloco para exibir erros de validação --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ops!</strong> Ocorreram alguns problemas.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('candidatos.update', $candidato->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Diretiva que define o método como PUT para atualização --}}

            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                {{-- O "old()" tenta pegar um valor antigo (se a validação falhar), senão pega o valor do banco --}}
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $candidato->nome) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $candidato->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                {{-- Usamos o telefone_formatado para exibir, mas o nome do campo é 'telefone' --}}
                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $candidato->telefone_formatado) }}" placeholder="(99) 99999-9999" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Atualizar Candidato</button>
                <a href="{{ route('candidatos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    {{-- SCRIPTS PARA A MÁSCARA DO TELEFONE --}}
    <script src="https://unpkg.com/imask"></script>
    <script>
      var phoneMask = IMask(
        document.getElementById('telefone'), {
          mask: '(00) 00000-0000'
        }
      );
    </script>
</body>
</html>