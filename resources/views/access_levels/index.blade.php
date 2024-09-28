@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @include('layouts.pages_layouts.header')
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
                                    <th>Nivel de Acesso</th>
                                    <th>Ordem</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accesLevels as $accessLevel)
                                    <tr>
                                        <td>{{ $accessLevel->name }}</td>
                                        <td>{{ $accessLevel->order }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->

                        <div class="card-footer clearfix">
{{--                            {{ $users->links() }}--}}
                        </div>

                    </div><!-- /.card -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->

@endsection
