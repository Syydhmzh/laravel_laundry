@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <div class="mb-3" align="right">
                    <a href="{{ route('trans.create') }}" class="btn btn-success">Tambah</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Tnggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $data )
                        <tr>
                            <td>{{ $key += 1}} </td>
                            <td><a href="{{ route('trans.show', $data->id) }}">{{ $data->order_code }}</a> </td>
                            <td>{{ $data->customer->name }}</td>
                            <td>{{ $data->order_end_date }}</td>
                            <td>{{ $data->status_text}}</td>
                            <td>
                                <a href="{{ route('print_struk', $data->id) }}" class="btn btn-warning btn-sm">Print</a>
                                <a href="{{ route('trans.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('trans.destroy', $data->id) }}" method="POST" class="d-inline">
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
