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
                            <h3>{{ __('Informações do Cliente') }}</h3>
                            <div class="form-group row">
                                <!-- Nome -->
                                <div class="col-md-6">
                                    <label>{{ __('Nome') }}</label>
                                    <p>{{ $clientData->nome }}</p>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label>{{ __('Email') }}</label>
                                    <p>{{ $clientData->email }}</p>
                                </div>
                            </div>
                            <hr>

                            <!-- Campos de contato -->
                            <h3>{{ __('Contato') }}</h3>
                        @if($clientData->contacts)
                            @foreach($clientData->contacts as $contatos)
                                    <div class="form-group row">
                                        <!-- Celular -->
                                        <div class="col-md-6">
                                            <label>{{ __('Celular') }}</label>
                                            <p class="mb-0">
                                                {{ isset($contatos->ddd_cel, $contatos->numero_cel) ? '(' . $contatos->ddd_cel . ') ' . substr($contatos->numero_cel, 0, 5) . '-' . substr($contatos->numero_cel, 5) : 'N/A' }}
                                            </p>
                                        </div>

                                        <!-- Telefone -->
                                        <div class="col-md-6">
                                            <label>{{ __('Telefone') }}</label>
                                            <p class="mb-0">
                                                {{ isset($contatos->ddd_tel, $contatos->numero_tel) ? '(' . $contatos->ddd_tel . ') ' . substr($contatos->numero_tel, 0, 4) . '-' . substr($contatos->numero_tel, 4) : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @else
                                <p>{{ __('Não foram encontrados contato para este usuário.') }}</p>
                            @endif
                        <!-- Campos de endereço -->
                            <h3>{{ __('Endereço') }}</h3>

                            @if($clientData->enderecos)
                                @foreach($clientData->enderecos as $endereco)
                                    <div class="form-group">
                                        <label>{{ __('CEP') }}</label>
                                        <p>{{ $endereco->cep }}</p>
                                    </div>

                                    <div class="form-group row">
                                        <!-- Logradouro -->
                                        <div class="col-md-8">
                                            <label>{{ __('Logradouro:') }}</label>
                                            <p class="mb-0">{{ $endereco->logradouro }}</p>
                                        </div>

                                        <!-- Número -->
                                        <div class="col-md-4">
                                            <label>{{ __('Número:') }}</label>
                                            <p class="mb-0">{{ $endereco->numero }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Complemento') }}</label>
                                        <p>{{ $endereco->complemento }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <!-- Bairro -->
                                        <div class="col-md-6">
                                            <label>{{ __('Bairro') }}</label>
                                            <p class="mb-0">{{ $endereco->bairro }}</p>
                                        </div>

                                        <!-- Cidade -->
                                        <div class="col-md-6">
                                            <label>{{ __('Cidade') }}</label>
                                            <p class="mb-0">{{ $endereco->cidade }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- Estado -->
                                        <div class="col-md-6">
                                            <label>{{ __('Estado') }}</label>
                                            <p class="mb-0">{{ $endereco->estado }}</p>
                                        </div>

                                        <!-- País -->
                                        <div class="col-md-6">
                                            <label>{{ __('País') }}</label>
                                            <p class="mb-0">{{ $endereco->pais ?? 'Brasil' }}</p>
                                        </div>
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
