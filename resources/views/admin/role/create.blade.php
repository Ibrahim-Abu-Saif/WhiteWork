@extends('admin.master')

@section('title', 'Add  Roles| ' . env('APP_NAME'))


@section('content')

    <h1 class="mb-3 ml-3">Add New role</h1>

<div class="container">
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Nmae:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name"
                value="{{ old('name') }}">
            @error('name')
            <small class="invalid-feedback">{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Roles</label>

            <ul class="list-unstyled" style="column-count:3">
                <li><label><input  type="checkbox" id="selectAll">Select All</label></li>
                @foreach ($permissions as $p )
                <li><label><input class="checkbox" type="checkbox" name="permissions[]" value="{{$p->id}}">{{$p->name}}</label></li>
                @endforeach
            </ul>
        </div>
        <button class="btn btn-success my-3">Add</button>
    </form>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
       $('#selectAll').click(function() {
       $('.checkbox').prop('checked', $(this).prop('checked'));
  });
});
</script>

@endsection
