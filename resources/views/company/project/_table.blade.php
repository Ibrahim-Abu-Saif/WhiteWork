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
        <th>Payment</th>
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
                ? '<span onclick="edit_status(event,' .
                    $project->id .
                    ')" class=" status badge badge-success text-white">Open</span>'
                : '<span onclick="edit_status(event,' .
                    $project->id .
                    ')" class=" status text-white badge badge-danger">Close</span>' !!}</td>
            <td>
                @foreach ($project->skills as $skill)
                    <span class="badge bg-primary text-white">{{ $skill->name }}</span>
                @endforeach
            </td>
            <td>{{ $project->category->name }}</td>
            <td>
                @if($project->payment)
                {{$project->payment->created_at}}
                @else
                <a class="btn btn-success btn-sm" href="{{route('company.projects.pay',$project)}}">Pay Now</a>
                @endif

            </td>
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
