@extends('layouts.app')

@section('content')
    <style>
        label { margin-right: 8px; }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Agendamentos') }}</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('admin.appointments.calendar') }}" class="btn btn-info mr-2">
                            <i class="fas fa-calendar"></i> Visualizar Calendário
                        </a>
                    </div>
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
                                    <th>Paciente</th>
                                    <th>Profissional</th>
                                    <th>Data/Horário</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->user->name }}</td>
                                        <td>{{ $appointment->professional->name }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($appointment->schedule->date)->format('d/m/Y') }}<br>
                                            {{ \Carbon\Carbon::parse($appointment->schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($appointment->schedule->end_time)->format('H:i') }}
                                        </td>
                                        <td>
                                            @switch($appointment->status)
                                                @case('pending')
                                                <span class="badge badge-warning">Pendente</span>
                                                @break
                                                @case('confirmed')
                                                <span class="badge badge-success">Confirmado</span>
                                                @break
                                                @case('canceled')
                                                <span class="badge badge-danger">Cancelado</span>
                                                @break
                                                @case('completed')
                                                <span class="badge badge-info">Concluído</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
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
                            @if($appointments->total() > 0)
                                <div class="float-left">
                                    Mostrando {{ $appointments->firstItem() }} a {{ $appointments->lastItem() }} de {{ $appointments->total() }} registros
                                </div>
                                <div class="float-right">
                                    {{ $appointments->links() }}
                                </div>
                            @else
                                <div class="text-center">
                                    Nenhum agendamento encontrado
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
