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
                    <h1 class="m-0">{{ __('Profissionais') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <a href="{{ route('profissionais.create') }}" class="btn btn-success float-right">
                        <i class="fas fa-plus"></i> Novo Profissional
                    </a>
                </div>
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
                                    <th>Nome</th>
                                    <th>Especialidade</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th align="center">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($professionals as $professional)
                                    <tr>
                                        <td>{{ $professional->id }}</td>
                                        <td>{{ $professional->name }}</td>
                                        <td>{{ $professional->specialty }}</td>
                                        <td>{{ $professional->email }}</td>
                                        <td>
                                            @if($professional->status)
                                                <span class="badge badge-success">Ativo</span>
                                            @else
                                                <span class="badge badge-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Visualizar -->
                                            <a href="{{ route('profissionais.show', $professional->id) }}" class="btn btn-sm btn-primary" title="Visualizar">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Editar -->
                                            <a href="{{ route('profissionais.edit', $professional->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Deletar -->
                                            <form action="{{ route('profissionais.destroy', $professional->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este profissional?')" title="Excluir">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                            <!-- Horários (se aplicável) -->
                                            <a href="{{ route('profissionais.schedules', $professional->id) }}" class="btn btn-sm btn-info" title="Gerenciar Horários">
                                                <i class="fas fa-calendar-alt"></i>
                                            </a>

                                            <!-- Agenda (se aplicável) -->
                                            <a href="{{ route('profissionais.agenda', $professional->id) }}" class="btn btn-sm btn-success" title="Ver Agenda">
                                                <i class="fas fa-list"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

{{--                        <div class="card-footer clearfix">--}}
{{--                            <!-- Paginação -->--}}
{{--                            @if($professionals->total() > 0)--}}
{{--                                <div class="float-left">--}}
{{--                                    Mostrando {{ $professionals->firstItem() }} a {{ $professionals->lastItem() }} de {{ $professionals->total() }} registros--}}
{{--                                </div>--}}
{{--                                <div class="float-right">--}}
{{--                                    {{ $professionals->links() }}--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="text-center">--}}
{{--                                    Nenhum profissional cadastrado--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
