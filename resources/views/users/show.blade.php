@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-lg-6 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nome -->
                            <h3>{{ __('Informações do Usuário') }}</h3>
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <p>{{ $userData->name }}</p>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <p>{{ $userData->email }}</p>
                            </div>
                            <hr>

                            <!-- Campos de contato -->
                            <h3>{{ __('Contato') }}</h3>
                            @if($userData->contacts)
                                @foreach($userData->contacts as $contatos)
                                    <!-- DDD Celular -->
                                    <div class="form-group">
                                        <label>{{ __('DDD Cel') }}</label>
                                        <p>{{ $contatos->ddd_cel ?? 'N/A' }}</p>
                                    </div>

                                    <!-- Número Celular -->
                                    <div class="form-group">
                                        <label>{{ __('Número Cel') }}</label>
                                        <p>{{ $contatos->numero_cel ?? 'N/A' }}</p>
                                    </div>

                                    <!-- DDD Telefone -->
                                    <div class="form-group">
                                        <label>{{ __('DDD Tel') }}</label>
                                        <p>{{ $contatos->ddd_tel ?? 'N/A' }}</p>
                                    </div>

                                    <!-- Número Telefone -->
                                    <div class="form-group">
                                        <label>{{ __('Número Tel') }}</label>
                                        <p>{{ $contatos->numero_tel ?? 'N/A' }}</p>
                                    </div>
                                    <hr>
                                @endforeach
                            @else
                                <p>{{ __('Não foram encontrados contato para este usuário.') }}</p>
                            @endif
                            <!-- Campos de endereço -->
                            <h3>{{ __('Endereço') }}</h3>

                            @if($userData->enderecos)
                                @foreach($userData->enderecos as $endereco)
                                    <div class="form-group">
                                        <label>{{ __('CEP') }}</label>
                                        <p>{{ $endereco->cep }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Logradouro') }}</label>
                                        <p>{{ $endereco->logradouro }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Número') }}</label>
                                        <p>{{ $endereco->numero }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Complemento') }}</label>
                                        <p>{{ $endereco->complemento }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Bairro') }}</label>
                                        <p>{{ $endereco->bairro }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Cidade') }}</label>
                                        <p>{{ $endereco->cidade }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Estado') }}</label>
                                        <p>{{ $endereco->estado }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('País') }}</label>
                                        <p>{{ $endereco->pais ?? 'Brasil' }}</p>
                                    </div>

                                    <hr>
                                @endforeach
                            @else
                                <p>{{ __('Não foram encontrados dados de endereço.') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
