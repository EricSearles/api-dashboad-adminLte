@extends('layouts.app')

@section('content')
    <style>
        label { margin-right: 8px; }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Horários') }}</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('schedules.create') }}" class="btn btn-success float-right">
                        <i class="fas fa-plus"></i> Novo Horário
                    </a>
                </div>
            </div>
        </div>
    </div>

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
                                    <th>Profissional</th>
                                    <th>Data</th>
                                    <th>Horário</th>
                                    <th>Disponível</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->id }}</td>
                                        <td>{{ $schedule->professional->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                        <td>
                                            @if($schedule->available)
                                                <span class="badge badge-success">Disponível</span>
                                            @else
                                                <span class="badge badge-danger">Ocupado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                         <div class="card-footer clearfix">
                            @if($schedules->total() > 0)
                                <div class="float-left">
                                    Mostrando {{ $schedules->firstItem() }} a {{ $schedules->lastItem() }} de {{ $schedules->total() }} registros
                                </div>
                                <div class="float-right">
                                    {{ $schedules->links() }}
                                </div>
                            @else
                                <div class="text-center">
                                    Nenhum horário cadastrado
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
