@extends('app')
@section('content')

<div class="row">
    <div class="col-10">
        <div class="card">
            <div class="card-header">Create Service</div>
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <form action="{{ route('service.store') }}" method="POST" >
                    @csrf
                    <label for="">Name Service</label>
                    <input type="text" class="form-control" name="service_name" required>
                    <label for="">Price</label>
                    <input type="Number" class="form-control" name="price" required>
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="masukkan notes..."></textarea>

                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
