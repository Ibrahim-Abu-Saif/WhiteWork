@extends('company.master')

@section('title', 'Add New Project| ' . env('APP_NAME'))

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--multiple {
            min-height: 38px
        }
    </style>
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select_2').select2();
        });
    </script>
@endsection

@section('content')
    {{-- id	name	image		price	duration	status	category_id --}}
    <div class="card">
        <div class="card-header">
            Add New Project</div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('company.projects.update',$project) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="my-3">
                        <label for="name">Nmae:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter Projects Name" value="{{ old('name',$project->name) }}">
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="image">Image:</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            value="{{ old('image') }}">
                        @error('image')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <img width="100" src="{{asset('img/'.$project->image)}}" alt="">

                    <div class="my-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price',$project->price) }}">
                        @error('price')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="content">Content:</label>
                        <textarea class="form-control @error('price') is-invalid @enderror" name="content" id="content" cols="5">{{ old('content',$project->content) }}</textarea>
                        @error('content')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="duration">Duration:</label>
                        <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror"
                             value="{{ old('duration',$project->duration) }}">
                        @error('duration')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="category_id">Category:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                            <option value="">-- select Category --</option>
                            @foreach ($categories as $category)
                                <option @selected( $category->id == old('category_id',$project->category_id) ) value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="skills">Skills:</label>
                        <br>
                        <select class="select_2 form-select @error('skills') is-invalid @enderror" name="skills[]"
                            multiple="multiple">
                            <option value="">-- select Skills --</option>
                            @foreach ($skills as $skill)
                                <option @selected( $project->skills->find($skill) ) value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
                        @error('skills')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>



                    <button class="btn btn-success my-3">edit</button>
                </form>
            </div>
        </div>
    </div>



@endsection
