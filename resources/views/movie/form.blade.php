@extends('main')

@section('page')
<div>
    <div>
       Edit movie {{ $movie->id ?? old('id') }}
    </div>
    <div>
        <form method="POST" action="{{ url('/catalog/update') }}">
            {{-- Two hidden fields to prevent the CSRF attack. --}}
            {{-- https://es.wikipedia.org/wiki/Cross-site_request_forgery --}}
            {{ method_field('POST') }}
            {{ csrf_field() }}
            <div>
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') ?? $movie->title }}" />
                <label for="year">Year *</label>
                <input type="number" id="year" name="year" value="{{ old('year') ?? $movie->year }}" />
                <label for="synopsis">Synopsis</label>
                <textarea id="synopsis" name="synopsis">{{ old('synopsis') ?? $movie->synopsis }}</textarea>
            </div>
            <div>                
                <button type="submit" name="action" value="update">Update movie</button>
            </div>
            <label>* Required fields</label>
            <input type="hidden" id="id" name="id" value="{{ old('id') ?? $movie->id }}">
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