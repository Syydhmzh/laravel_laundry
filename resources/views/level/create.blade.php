@extends('app')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <form action="{{ route('level.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="">Nama Level</label>
                        <input type="text"  placeholder="Masukkan Nama Level" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


@endsection
