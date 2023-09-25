@extends('admin.master')

@section('title', 'All Ctegories| ' . env('APP_NAME'))


@section('content')

    <h1 class="mb-3 ml-3">Add New Category</h1>

<div class="container">
    <form action="{{ route('admin.Category.store') }}" method="POST">
        @csrf
        <label for="name">Nmae:</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name"
            value="{{ old('name') }}">
        @error('name')
        <small class="invalid-feedback">{{$message}}</small>
        @enderror

        <button class="btn btn-success my-3">Add</button>
    </form>
</div>


@endsection
