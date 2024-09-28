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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Clientes') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th align="center">Ações</th> <!-- Nova coluna para ações -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->nome }}</td>
                                        <td>{{ $client->cpf }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>
                                            <!-- Links para visualizar, editar e deletar -->
                                            <a href="{{ route('clients.show', ['id' => $client->id]) }}" class="btn btn-sm btn-primary" title="Visualizar Cliente">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-sm btn-warning" title="Editar Cliente">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Você tem certeza que deseja deletar este cliente?')" title="Deletar Cliente">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                            <!-- Botão Cadastrar Endereço -->
                                            <a href="{{ route('client.add-endereco-form', ['id' => $client->id]) }}" class="btn btn-sm btn-info {{ $client->hasEndereco ? 'disabled' : '' }}" title="Cadastrar Endereço">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </a>

                                            <!-- Botão Cadastrar Contato -->
                                            <a href="{{ route('client.add-contato', ['id' => $client->id]) }}" class="btn btn-sm btn-success" title="Cadastrar Contato">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            <!-- Renderização dos links de paginação -->
                            {{ $clients->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
