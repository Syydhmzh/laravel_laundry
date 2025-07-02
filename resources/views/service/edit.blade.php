@extends('app')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <form action="{{ route('service.update', $service->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Nama service</label>
                        <input type="text" value="{{ $service->service_name }}"  placeholder="Masukkan Nama service" name="service_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">price</label>
                        <input type="text" value="{{ $service->price }}"  placeholder="Masukkan Nama service" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Nama service</label>
                        <input type="text" value="{{ $service->description }}"  placeholder="Masukkan Nama service" name="description" class="form-control" required>
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
