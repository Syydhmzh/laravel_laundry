@extends('app')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <form action="{{ route('trans.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">No Pesanan</label>
                            <input type="text"  name="order_code" class="form-control" readonly value="{{ $ordercode ?? '' }}">

                            <div class="mt-3">
                                <label for="">Nama Pelanggan</label>
                                <select name="id_customer" id="" class="form-control">
                                    <option value="">Pilih Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="">Tanggal Selesai</label>
                                <input type="date" name="order_end_date" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="">Nama Paket</label>
                                <select name="id_service" id="id_service" class="form-control">
                                    <option value="">Pilih Paket</option>
                                    @foreach ($services as $service)
                                        <option data-price="{{ $service->price }}" value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                                <label for="">Catatan</label>
                                <textarea name="note" class="form-control" placeholder="Masukkan catatan" required></textarea>


                        </div>

                        {{-- <div class="col-sm-6">
                            <label for="">Tanggal selesai</label>
                            <input type="date"  placeholder="Masukkan Tanggal Selesai" name="order_end_date" class="form-control" required>
                        </div> --}}

                    </div>
                    <div class="mt-3 mb-3">
                        <div align="right" class="mb-3">
                            <button type="button" class="btn btn-primary addRow">Tambah Row</button>
                        </div>
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <br>
                            <p>
                            <strong>Grand Total : Rp <span id="grandTotal">0</span></strong>
                            <div class="mb-3">
                                <input type="hidden" name="grand_total" id="grandTotalInput" value=0>
                            </div>
                            </p>
                    </div>

                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                </form>
            </div>
        </div>

    </div>
</div>


@endsection
