@extends('home')

@section('content')
<div class="card">
    <div class="card-header text-center">
       Add product
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/product/create') }}">
            {{-- crear dos campos ocultos para prevenir el ataque CSRF --}}
            {{-- https://es.wikipedia.org/wiki/Cross-site_request_forgery --}}
            {{ method_field('POST') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name *:</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" />

                <label for="price">Price *:</label>
                <input class="form-control" type="text" id="price" name="price" value="{{ old('price') }}" />

                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>

                {{-- TODO select --}}
                {{-- <label for="category">Category *:</label>
                <select name="category" id="category"> --}}
                    
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Create</button>
                <button class="btn btn-warning" type="reset">Reset Form</button>
                <a class="btn btn-dark" href="{{ route('product-create') }}">Reload Page</a>
                <a class="btn btn-info" href="{{ url('/product/list') }}">Go Back to List</a>
            </div>

            <label class="alert alert-light">* Required fields</label>
        </form>
    </div>
</div>
@stop

@section('message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @isset($message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endisset
@stop