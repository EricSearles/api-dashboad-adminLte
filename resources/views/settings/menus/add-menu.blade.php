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
                <h1 class="m-0">Adicionar Menu</h1>
            </div>
        </div>
    </div>
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

                        <form action="{{ route('settings.menu.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="icon">Ícone</label>
                                <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}">
                            </div>

                            <div class="form-group">
                                <label for="posicao">Posição</label>
                                <input type="text" class="form-control" id="posicao" name="posicao" value="{{ old('posicao') }}">
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo') }}">
                            </div>

                            <div class="form-group">
                                <label for="route_name">Rota</label>
                                <input type="text" class="form-control" id="route_name" name="route_name" value="{{ old('route_name') }}">
                            </div>

                            <div class="form-group">
                                <label for="order">Ordem</label>
                                <input type="number" class="form-control" id="order" name="order" value="{{ old('order') }}">
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Pai</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">Nenhum</option>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ old('parent_id') == $menu->id ? 'selected' : '' }}>
                                            {{ $menu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status_id">Status</label>
                                <select class="form-control" id="status_id" name="status_id" required>
                                    <option value="1" {{ old('status_id') == '1' ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ old('status_id') == '0' ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Adicionar Menu</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </form>
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