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
                    <h1 class="m-0">{{ __('Users') }}</h1>
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

{{--                    <div class="alert alert-info">--}}
{{--                        Sample table page--}}
{{--                    </div>--}}

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Nivel Acesso</th>
        <th>Ações</th> <!-- Nova coluna para ações -->
    </tr>
</thead>
<tbody>
@foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->nivel_acesso }}</td>
        <td>
            <!-- Links para visualizar, editar e deletar -->
            <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-eye"></i>
            </a>
            <a href="#" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
            </a>
            <form action="#" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Você tem certeza que deseja deletar este usuário?')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach
</tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
