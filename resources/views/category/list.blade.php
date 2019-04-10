@extends('home')

@section('content')
    @isset($categories)
    <div class="card">
        <div class="card-header text-center">
           Categories List
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tr class="thead-dark">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                @foreach ($categories as $category)
                    <tr>
                        <td><a href="{{ url('/category/edit/' . $category->id) }}">{{ $category->id }}</a></td>
                        <td><a href="{{ url('/category/edit/' . $category->id) }}">{{ $category->name }}</a></td>
                        <td>{{ $category->description }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endisset
@stop

@section('message')
    @if(isset($message))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
@stop
