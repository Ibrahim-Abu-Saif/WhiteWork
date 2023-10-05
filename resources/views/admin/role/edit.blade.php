@extends('admin.master')

@section('title', 'Edir role| ' . env('APP_NAME'))


@section('content')

    <h1 class="mb-3 ml-3">Edite {{$role->name}}</h1>

<div class="container">
    <form action="{{ route('admin.roles.update',$role) }}" method="POST">
        @csrf
        @method('put')
        <label for="name">Nmae:</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name"
            value="{{ old('name',$role->name) }}">
        @error('name')
        <small class="invalid-feedback">{{$message}}</small>
        @enderror

        <button class="btn btn-success my-3">edit</button>
    </form>
</div>


@endsection
