@extends('layouts.admin')

@section('content')

{{-- @dd($technology) --}}

    <h1>Elenco Progetti con Tecnologie {{$technology->name}}</h1>

        <table class="table">
            <thead>
                <th scope="col">ID</th>
                <th scope="col">Nome progetto</th>
            </thead>
            <tbody>
                @foreach ($technology->projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->title }}</td>
                    <td><a class="btn btn-success" href="{{route('admin.projects.show',$project)}}"><i class="fa-solid fa-eye"></i></a>
                        <a class="btn btn-warning" href="{{route('admin.projects.edit',$project)}}"><i class="fa-solid fa-pencil"></i></a>
                        @include('admin.partials.delete_button',[
                            'route' => route('admin.projects.destroy', $project),
                            'message' => 'Sei sicuro di voler eliminare questo Progetto?'
                        ])
                    </td>
                </tr>

                @endforeach
                </tbody>
        </table>
@endsection
