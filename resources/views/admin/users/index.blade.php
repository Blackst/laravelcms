@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>
        Meus Usuários
    <a href="{{route('users.create')}}" class="btn btn-sm btn-success">Novo Usuário</a>
    </h1>
@endsection

@section('content')
    
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach ($users as $user)
                   <tbody>
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{route('users.edit', ['user'=> $user->id])}}" class="btn btn-sm btn-info">Editar</a>
                            <form class="d-inline" action="{{route('users.destroy', ['user'=> $user->id])}}" method="POST" onsubmit="return confirm('Deseja realmente excluir este usuário ?')">
                                @csrf

                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">Excluir</button>

                            </form>
                        </td>
                    </tr>
                   </tbody>
                @endforeach
            </table>
        </div>
    </div>

    {{ $users->links()}}
@endsection