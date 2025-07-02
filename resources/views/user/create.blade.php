@extends('app')
@section('content')

<div class="row">
    <div class="col-10">
        <div class="card">
            <div class="card-header">Create Service</div>
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <form action="{{ route('user.store',) }}" method="POST" >
                    @csrf
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="service_name" required>
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required>
                    <label for="">Password</label>
                    <input name="password" id="" cols="30" rows="5" class="form-control" placeholder="masukkan notes..."></input>

                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
