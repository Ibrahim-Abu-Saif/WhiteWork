@extends('admin.master')

@section('title', 'All Roles| ' . env('APP_NAME'))


@section('content')


    <h1 class="mb-3 ml-3">All roles</h1>
    <table class="table table-bordered text-center">
        <tr class="bdge bg-dark text-white">
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Action</th>
        </tr>

        @forelse ($roles as $role)
            <tr>

                <td style="width: 11%">{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td style="width: 25%">{{ $role->created_at->format('M d,Y : h:i:s a') }}</td>
                <td style="width: 11%">
                    <a class="btn btn-info btn-sm" href="{{ route('admin.roles.edit', $role->id) }}"><i
                            class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_js(event)"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>

        @empty
            <tr>
                <td class="text-center" colspan="4">NO Data Found</td>
            </tr>
        @endforelse
    </table>
    {{ $roles->links() }}
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
                icon: '{{ session("type") }}',
                title: '{{session("msg")}}'
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
    </script>
@endsection
