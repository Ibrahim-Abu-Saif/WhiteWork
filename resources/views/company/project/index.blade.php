@extends('company.master')

@section('title', 'All Projects| ' . env('APP_NAME'))

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--multiple {
            min-height: 38px
        }


        table span {
            cursor: pointer;
        }
    </style>
@endsection


@section('content')
    {{-- id	name	image		price	duration	status	category_id --}}
    <div class="container">
        <div class="card">
            <!-- Button trigger modal -->


            <!-- Modal -->

            <div class="card-header d-flex justify-content-between align-items-center ">
                All Projects
                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNew" href="">Add Mew Project</a>
            </div>
            <div class="card-body">

            <div id="ttt" class="warp-content">
                @include('company.project._table')
            </div>
            </div>
        </div>
    </div>



@endsection

<div class="modal fade show " id="addNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add New Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="storProject(event)" action="{{ route('company.projects.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="fromIndex" value="fromIndex">
                    <div class="my-3">
                        <label for="name">Nmae:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter Projects Name" value="{{ old('name') }}">
                            <span class="text-danger"></span>
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="image">Image:</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            value="{{ old('image') }}">
                            <span class="text-danger"></span>
                        @error('image')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price') }}">
                            <span class="text-danger"></span>
                        @error('price')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="content">Content:</label>

                        <textarea class="form-control @error('price') is-invalid @enderror" name="content" id="content" cols="5">{{ old('content') }}</textarea>
                        <span class="text-danger"></span>
                        @error('content')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="duration">Duration:</label>
                        <input type="text" name="duration"
                            class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}">
                            <span class="text-danger"></span>
                        @error('duration')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="category_id">Category:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                            id="category_id">
                            <option value="">-- select Category --</option>
                            @foreach ($categories as $category)
                                <option @selected($category->id == old('category_id')) value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger"></span>
                        @error('category_id')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label for="skills">Skills:</label>
                        <br>
                        <select class="select_2 form-select @error('skills') is-invalid @enderror" name="skills[]"
                            multiple="multiple">
                            <option >-- select Skills --</option>
                            @foreach ($skills as $skill)
                                <option @selected(in_array($skill->id, old('skills') ?? [])) value="{{ $skill->id }}">{{ $skill->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger"></span>
                        @error('skills')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>



                    <button class="btn btn-success my-3 w-100">Add</button>
                </form>
            </div>

        </div>
    </div>
</div>


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>







    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (session('msg'))
            Toast.fire({
                icon: '{{ session('type') }}',
                title: '{{ session('msg') }}'
            })
        @endif


        function delete_js(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = e.target.closest('form').action
                    axios.post(url, {
                            _method: 'delete'
                        })
                        .then(res => {
                            e.target.closest('tr').remove()
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        })

                }
            })
        }









        function edit_status(e, id) {
            let url = '{{ route('company.projects.edit_status') }}/' + id

            axios.get(url)
                .then(res => {
                    // console.log();
                    if (res['data']) {
                        e.target.classList.remove('badge-danger')
                        e.target.classList.add('badge-success')
                        e.target.innerHTML = 'Open'
                    } else {
                        e.target.classList.remove('badge-success')
                        e.target.classList.add('badge-danger')
                        e.target.innerHTML = 'Close'
                    }

                })

        }

        function storProject(e) {
            e.preventDefault()
            let data = new FormData(e.target)
            // console.log(e.target)
            let url = e.target.action
            // console.log(e.target.action)
            axios.post(url,data)

            .then(res =>{
                // console.log( );
                document.querySelector('#ttt').innerHTML=res.data
                $('#addNew').modal('hide')


            })

            .catch(err => {
                let fileds=document.querySelectorAll('.modal-body .form-control,.modal-body .form-select')
                fileds.forEach(el =>{
                    let name=el.name.replace('[]','')
                    // console.log(err.response.data.errors['skills'])
                    if(err.response.data.errors[name]){
                        el.closest('.my-3').querySelector('.text-danger').innerHTML=err.response.data.errors[name][0]
                        el.classList.add('is-invalid')
                    }
                    else{
                        el.closest('.my-3').querySelector('.text-danger').innerHTML=''
                        el.classList.remove('is-invalid')
                    }


                })


            })
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select_2').select2();
        });
    </script>
@endsection
