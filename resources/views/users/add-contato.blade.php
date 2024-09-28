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
                <h1 class="m-0">Adicionar Contato para {{ $user->name }}</h1>
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

                        <form action="{{ route('user.add-contato', $user->id) }}" method="POST">
                            @csrf

                            <!-- DDD Celular -->
                            <div class="form-group">
                                <label for="ddd_cel">DDD Celular</label>
                                <input type="text" class="form-control" id="ddd_cel" name="ddd_cel" value="{{ old('ddd_cel') }}" required>
                            </div>

                            <!-- Número Celular -->
                            <div class="form-group">
                                <label for="numero_cel">Número Celular</label>
                                <input type="text" class="form-control" id="numero_cel" name="numero_cel" value="{{ old('numero_cel') }}" required>
                            </div>

                            <!-- DDD Telefone -->
                            <div class="form-group">
                                <label for="ddd_tel">DDD Telefone</label>
                                <input type="text" class="form-control" id="ddd_tel" name="ddd_tel" value="{{ old('ddd_tel') }}" required>
                            </div>

                            <!-- Número Telefone -->
                            <div class="form-group">
                                <label for="numero_tel">Número Telefone</label>
                                <input type="text" class="form-control" id="numero_tel" name="numero_tel" value="{{ old('numero_tel') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Adicionar Contato</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </form>

                        <hr>

                        <h3>Contatos Existentes</h3>
                        <ul class="list-group">
                            @foreach($user->contacts as $contato)
                                <li class="list-group-item">
                                    <strong>Celular:</strong> ({{ $contato->ddd_cel }}) {{ $contato->numero_cel }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Telefone:</strong> ({{ $contato->ddd_tel }}) {{ $contato->numero_tel }}
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
