@extends('home')

@section('content')
    @isset($products)
    <div class="card">
        <div class="card-header text-center">
           Products List
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tr class="thead-dark">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category</th>
                </tr>
                @foreach ($products as $product) 
                    <tr>
                        <td><a href="{{ url('/product/edit/' . $product->id) }}">{{ $product->id }}</a></td>
                        <td><a href="{{ url('/product/edit/' . $product->id) }}">{{ $product->name }}</a></td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        @isset ($product->category)
                            <td><a href="{{ url('/category/edit/' . $product->category->id) }}">{{ $product->category->name }}</a></td>
                        @endisset
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