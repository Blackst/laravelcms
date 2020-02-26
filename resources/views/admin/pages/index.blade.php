@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <h1>
        Minhas Páginas
    <a href="{{route('pages.create')}}" class="btn btn-sm btn-success">Nova Página</a>
    </h1>
@endsection

@section('content')
    
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach ($pages as $page)
                   <tbody>
                    <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->title}}</td>
                        <td>
                            <a href="{{route('pages.edit', ['page'=> $page->id])}}" class="btn btn-sm btn-info">Editar</a>
                                <form class="d-inline" action="{{route('pages.destroy', ['page'=> $page->id])}}" method="POST" onsubmit="return confirm('Deseja realmente excluir está página ?')">
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

    {{ $pages->links()}}
@endsection