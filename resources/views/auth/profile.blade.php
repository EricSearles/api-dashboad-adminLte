@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('My profile') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-lg-6 col-md-8">
                    <div class="card">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <!-- Nome -->
                                <div class="input-group mb-3">
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="{{ __('Name') }}"
                                           value="{{ old('name', $userWithEnderecos->name) }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="input-group mb-3">
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="{{ __('Email') }}"
                                           value="{{ old('email', $userWithEnderecos->email) }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <!-- Senha -->
                                <div class="input-group mb-3">
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="{{ __('New password') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <!-- Confirmação da senha -->
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           placeholder="{{ __('New password confirmation') }}"
                                           autocomplete="new-password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campos de endereço -->
                                <h3>{{ __('Addresses') }}</h3>

                                @if($userWithEnderecos->enderecos)
                                    @foreach($userWithEnderecos->enderecos as $endereco)
                                        <!-- Campo oculto com ID do endereço -->
                                        <input type="hidden" name="enderecos[{{ $loop->index }}][id]" value="{{ $endereco->id }}">
                                        
                                        <!-- CEP -->
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input type="text" class="form-control" id="zip_code" name="enderecos[{{ $loop->index }}][cep]" value="{{ old('enderecos.'.$loop->index.'.cep', $endereco->cep) }}" required>
                                        </div>

                                        <!-- Logradouro -->
                                        <div class="form-group">
                                            <label for="logradouro">Logradouro</label>
                                            <input type="text" class="form-control" id="street" name="enderecos[{{ $loop->index }}][logradouro]" value="{{ old('enderecos.'.$loop->index.'.logradouro', $endereco->logradouro) }}" required>
                                        </div>

                                        <!-- Número -->
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="text" class="form-control" id="numero" name="enderecos[{{ $loop->index }}][numero]" value="{{ old('enderecos.'.$loop->index.'.numero', $endereco->numero) }}" required>
                                        </div>

                                        <!-- Complemento -->
                                        <div class="form-group">
                                            <label for="complemento">Complemento</label>
                                            <input type="text" class="form-control" id="complemento" name="enderecos[{{ $loop->index }}][complemento]" value="{{ old('enderecos.'.$loop->index.'.complemento', $endereco->complemento) }}" required>
                                        </div>

                                        <!-- Bairro -->
                                        <div class="form-group">
                                            <label for="bairro">Bairro</label>
                                            <input type="text" class="form-control" id="neighborhood" name="enderecos[{{ $loop->index }}][bairro]" value="{{ old('enderecos.'.$loop->index.'.bairro', $endereco->bairro) }}" required>
                                        </div>

                                        <!-- Cidade -->
                                        <div class="form-group">
                                            <label for="cidade">Cidade</label>
                                            <input type="text" class="form-control" id="city" name="enderecos[{{ $loop->index }}][cidade]" value="{{ old('enderecos.'.$loop->index.'.cidade', $endereco->cidade) }}" required>
                                        </div>

                                        <!-- Estado -->
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <input type="text" class="form-control" id="state" name="enderecos[{{ $loop->index }}][estado]" value="{{ old('enderecos.'.$loop->index.'.estado', $endereco->estado) }}" required>
                                        </div>

                                        <!-- País -->
                                        <div class="form-group">
                                            <label for="pais">País</label>
                                            <input type="text" class="form-control" id="pais" name="enderecos[{{ $loop->index }}][pais]" value="{{ old('enderecos.'.$loop->index.'.pais', $endereco->pais ?? 'Brasil') }}" required>
                                        </div>

                                        <hr>
                                    @endforeach
                                @endif

                            </div>

                            <!-- Botão de envio -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
<script>
    document.querySelectorAll('#search_address').forEach(function(button) {
        button.addEventListener('click', function() {
            let cep = button.closest('.form-group').querySelector('#zip_code').value;

            if (cep.length === 8 || cep.length === 9) { // Verifica se o CEP tem 8 dígitos (ou 9 com hífen)
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            button.closest('.form-group').querySelector('#street').value = data.logradouro;
                            button.closest('.form-group').querySelector('#neighborhood').value = data.bairro;
                            button.closest('.form-group').querySelector('#city').value = data.localidade;
                            button.closest('.form-group').querySelector('#state').value = data.uf;
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
    });
</script>
@endsection