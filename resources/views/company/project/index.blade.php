@extends('company.master')

@section('title', 'All Projects| ' . env('APP_NAME'))

@section('css')
<style>
table span{
        cursor: pointer;
    }
</style>
@endsection


@section('content')
    {{-- id	name	image		price	duration	status	category_id --}}
    <div class="card">
        <div class="card-header">
            All Projects</div>
        <div class="card-body">

            <table class="table table-bordered text-center ">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nmae</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Skills</th>
                    <th>category</th>
                    <th>Action</th>

                </tr>

                @forelse ($projects as $project )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img width="80px" src="{{ asset('img/' . $project->image) }}" alt="Project Image"></td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->price }}$</td>
                        <td>{{ $project->duration }}</td>
                        <td>{!! $project->status
                            ? '<span onclick="edit_status(event,' . $project->id . ')" class=" status badge badge-success text-white">Open</span>'
                            : '<span onclick="edit_status(event,' . $project->id . ')" class=" status text-white badge badge-danger">Close</span>' !!}</td>
                        <td>
                            @foreach ($project->skills as $skill)
                                <span class="badge bg-primary text-white">{{ $skill->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $project->category->name }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('company.projects.edit', $project) }}"><i
                                    class="fas fa-edit"></i></a>
                            <form class="d-inline" action="{{ route('company.projects.destroy', $project) }}"
                                method="POST">
                                @csrf
                                @method('delete')

                                <button type="button" class="btn btn-danger btn-sm" onclick="delete_js(event)"><i
                                        class="fas fa-trash"></i></button>

                            </form>
                        </td>


                    </tr>

                @empty
                    <tr>
                        <td class="text-center" colspan="8">NO Data Found</td>
                    </tr>
                @endforelse
            </table>
            {{ $projects->links() }}
        </div>
    </div>



@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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

        @if(session('msg'))
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

                }
        )

        }
    </script>
@endsection
