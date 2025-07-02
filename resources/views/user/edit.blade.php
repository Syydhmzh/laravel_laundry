@extends('app')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <form action="{{ route('user.update', $user->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Nama User</label>
                        <input type="text" value="{{ $user->name }}"  placeholder="Masukkan Nama user" name="user_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" value="{{ $user->email }}"  placeholder="Masukkan email anda" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" value="{{ $user->email }}"  placeholder="Masukkan email anda" name="price" class="form-control" required>
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
