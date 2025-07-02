@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <div class="mb-3" align="right">
                    <a href="{{ route('level.create') }}" class="btn btn-success">Tambah</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama service</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $data )
                        <tr>
                            <td>{{ $key += 1}} </td>
                            <td>{{ $data->service_name }}</td>
                            <td>{{ number_format($data->price) }}</td>
                            <td>{{ $data->description }}</td>
                            <td>
                                <a href="{{ route('level.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('level.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
