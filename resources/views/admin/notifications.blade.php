@extends('layouts.app')

@section('content')

        <div class="col-12">
            <a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn-success">Marcar todas como lidas</a>
            <hr>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Notificação</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tboby>
                @forelse($unreadNotifications as $n)
                <tr>
                    <td>{{$n->data['message']}}</td>
                    <td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
                    <!-- https://carbon.nesbot.com/ -->
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.notifications.read',['notification' => $n->id])}}" class="btn btn-sm btn-primary">Marcar como lida</a>

                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-warning">Nenhuma notificação encontrada</div>
                        </td>
                    </tr>
                @endforelse
            </tboby>
        </table>



@endsection
