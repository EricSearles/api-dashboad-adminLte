@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<style>
    label {
        margin-right: 8px;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <h1 class="m-0">Adicionar Endereço para {{ $user->name }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('user.add-endereco', $user->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" id="zip_code" name="cep" value="{{ old('cep') }}" required>
                                <button type="button" id="search_address" class="btn btn-secondary mt-2">Buscar Endereço</button>
                            </div>

                            <!-- Linha para Rua e Número -->
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="logradouro">Logradouro</label>
                                    <input type="text" class="form-control" id="street" name="logradouro" value="{{ old('logradouro') }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" id="neighborhood" name="bairro" value="{{ old('bairro') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" id="city" name="cidade" value="{{ old('cidade') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" id="state" name="estado" value="{{ old('estado') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="pais">País</label>
                                <input type="text" class="form-control" id="pais" name="pais" value="{{ old('pais', 'Brasil') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Adicionar Endereço</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                                
                            </div>
                        </form>

                        <hr>

                        <h3>Endereços Existentes</h3>
                        <ul class="list-group">
                            @foreach($user->enderecos as $endereco)
                                <li class="list-group-item">
                                    {{ $endereco->logradouro }}, {{ $endereco->numero }} - {{ $endereco->complemento }} - {{ $endereco->bairro }}
                                </li>
                                <li class="list-group-item">
                                    {{ $endereco->cidade }} - {{ $endereco->estado }} - {{ $endereco->pais }}
                                </li>
                                <li class="list-group-item">
                                   Cep: {{ $endereco->cep }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('scripts')
<script>
    document.getElementById('search_address').addEventListener('click', function() {
        let cep = document.getElementById('zip_code').value;

        if (cep.length === 8 || cep.length === 9) { // Verifica se o CEP tem 8 dígitos (ou 9 com hífen)
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('street').value = data.logradouro;
                        document.getElementById('neighborhood').value = data.bairro;
                        document.getElementById('city').value = data.localidade;
                        document.getElementById('state').value = data.uf;
                    } else {
                        alert('CEP não encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o endereço:', error);
                });
        } else {
            alert('Por favor, insira um CEP válido.');
        }
    });
</script>
@endsection
