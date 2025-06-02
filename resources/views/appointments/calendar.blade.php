@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Agenda - Visualização em Calendário</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <select id="professionalFilter" class="form-control">
                                    <option value="">Todos os Profissionais</option>
                                    @foreach($professionals as $professional)
                                        <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.1.0/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.1.0/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.1.0/main.min.css">
<style>
    #calendar {
        background-color: white;
    }
    .fc-event {
        cursor: pointer;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.1.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.1.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.1.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.1.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.1.0/locales/pt-br.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var professionalFilter = document.getElementById('professionalFilter');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'timeGrid', 'interaction' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
           // defaultView: 'timeGridWeek',
            views: {
        timeGridDay: {
            slotMinTime: "08:00",
            slotMaxTime: "20:00",
            slotDuration: "00:30:00",
            allDaySlot: false,
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
                meridiem: false
            }
        }
    },
            locale: 'pt-br',
            editable: false,
            events: {
                url: "{{ route('appointments.calendar.data') }}",
                extraParams: function() {
                    return {
                        professional_id: professionalFilter.value
                    };
                }
            },
            eventRender: function(info) {
                info.el.setAttribute('data-toggle', 'tooltip');
                info.el.setAttribute('title', info.event.extendedProps.description);
            },
            eventClick: function(info) {
                // Abrir modal ou página com detalhes do agendamento
                window.location.href = "/appointments/" + info.event.id;
            },
            eventDidMount: function(info) {
                // Verifica se é domingo (0 = Domingo, 6 = Sábado)
                if (info.event.start.getDay() === 0) {
                    info.el.style.backgroundColor = '#ffcccc'; // Cor mais clara para domingos
                    info.el.style.borderColor = '#ff9999';
                }
            }
        });

        calendar.render();
        
        // Recarregar eventos quando o filtro mudar
        professionalFilter.addEventListener('change', function() {
            calendar.refetchEvents();
        });
    });
</script>
@endsection