@extends('layouts.app')

@section('content')
    <style>
        label { margin-right: 8px; }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Menus') }}</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('settings.menu.create') }}" class="btn btn-success float-right">
                        <i class="fas fa-plus"></i> Novo Menu
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
                                    <th>Nome</th>
                                    <th>Icone</th>
                                    <th>Posição</th>
                                    <th>Tipo</th>
                                    <th>Rota</th>
                                    <th>Ordem</th>
                                    <th>Pai</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>
                                            @if($menu->icon)
                                                <i class="{{ $menu->icon }}"></i>
                                            @else
                                                <i class="fas fa-circle"></i>
                                            @endif
                                        </td>
                                        <td>{{ $menu->posicao }}</td>
                                        <td>{{ $menu->tipo }}</td>
                                        <td>{{ $menu->route_name }}</td>
                                        <td>{{ $menu->order }}</td>
                                        <td>
                                            @if($menu->parent_id)
                                                {{ $menu->parent_id }}
                                            @else
                                                Nenhum
                                            @endif              
                                        </td>
                                        <td>
                                            <form action="{{ route('settings.menu.status', $menu->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                            
                                                <label class="switch">
                                                    <input type="checkbox" onchange="this.form.submit()" {{ $menu->status_id == 1 ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                                <style>
                                                    .switch {
                                                        position: relative;
                                                        display: inline-block;
                                                        width: 34px;
                                                        height: 20px;
                                                    }

                                                    .switch input {
                                                        opacity: 0;
                                                        width: 0;
                                                        height: 0;
                                                    }

                                                    .slider {
                                                        position: absolute;
                                                        cursor: pointer;
                                                        top: 0;
                                                        left: 0;
                                                        right: 0;
                                                        bottom: 0;
                                                        background-color: #ccc;
                                                        transition: .4s;
                                                        border-radius: 20px;
                                                    }

                                                    .slider:before {
                                                        position: absolute;
                                                        content: "";
                                                        height: 14px;
                                                        width: 14px;
                                                        left: 3px;
                                                        bottom: 3px;
                                                        background-color: white;
                                                        transition: .4s;
                                                        border-radius: 50%;
                                                    }

                                                    input:checked + .slider {
                                                        background-color: #28a745;
                                                    }

                                                    input:checked + .slider:before {
                                                        transform: translateX(14px);
                                                    }
                                                </style>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('settings.menu.edit', $menu->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('settings.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este menu?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                        </div>
                         <div class="card-footer clearfix">
                            @if($menus->total() > 0)
                                <div class="float-left">
                                    Mostrando {{ $menus->firstItem() }} a {{ $menus->lastItem() }} de {{ $menus->total() }} registros
                                </div>
                                <div class="float-center">
                                    {{ $menus->links() }}
                                </div>
                            @else
                                <div class="text-center">
                                    Nenhum menu cadastrado
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection