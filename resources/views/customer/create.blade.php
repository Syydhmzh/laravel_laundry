@extends('app')
@section('content')

<div class="row">
    <div class="col-10">
        <div class="card">
            <div class="card-header">Create Service</div>
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <form action="{{ route('customer.store',) }}" method="POST" >
                    @csrf
                    <label for="">Name </label>
                    <input type="text" class="form-control" name="name" required>
                    <label for="">Phone</label>
                    <input type="number" class="form-control" name="phone" required>
                    <label for="">Address</label>
                    <textarea name="address" id="" cols="30" rows="5" class="form-control" placeholder="masukkan alamat anda"></textarea>

                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
