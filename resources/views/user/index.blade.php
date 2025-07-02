@extends('app')
@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="">Service manager</h1>
                </div>
                <div class="card-body">
                    <a href="{{ route('user.create') }}" class="btn btn-primary mt-2 mb-2">Create</a>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>
                                <tr>
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Email</th>
                                    <th>action</th>
                                </tr>
                            </th>
                            @foreach ($datas as $key => $data)

                            <tr>
                                <td>{{ $key += 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $data->id) }}" class="btn btn-success">Edit</a>
                                    <form action="" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="" class="btn btn-danger m-2" type="submit" onclick="return confirm('yakin mau hapus?')">Delete </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
