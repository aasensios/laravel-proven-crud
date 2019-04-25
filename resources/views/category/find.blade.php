@extends('home')

@section('content')
<div class="card">
    <div class="card-header text-center">
       Find category
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/category/find') }}">
            {{-- crear dos campos ocultos para prevenir el ataque CSRF --}}
            {{-- https://es.wikipedia.org/wiki/Cross-site_request_forgery --}}
            {{ method_field('POST') }}
            {{ csrf_field() }}
            <div class="form-group">
                <p>Fill one or both fields below (id has priority):</p>
                <label for="id">Id</label>
                <input class="form-control mb-3" type="text" id="id" name="id" value="{{ $id ?? old('id') }}" />

                <label for="name">Name</label>
                <input class="form-control mb-3" type="text" id="name" name="name" value="{{ $name ?? old('name') }}" />
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Find</button>
                <button class="btn btn-warning" type="reset">Reset Form</button>
                <a class="btn btn-dark" href="{{ route('category-find') }}">Reload Page</a>
                <a class="btn btn-info" href="{{ url('/category/list') }}">Go Back to List</a>
            </div>

            {{-- <label class="alert alert-light">* Required fields</label> --}}
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
